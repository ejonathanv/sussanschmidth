<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Article;
use App\Models\Exhibition;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index($startYear = null, $endYear = null){
        if ($startYear === null || $endYear === null) {
            $startYear = 2014;
            $endYear = (int) now()->format('Y');
        }
        
        $archives = $this->getArchivesByYearRange($startYear, $endYear);
        return view('website.index', compact('archives', 'startYear', 'endYear'));
    }

    public function archivesByYearRange($startYear, $endYear){
        return $this->index($startYear, $endYear);
    }

    private function getArchivesByYearRange($startYear, $endYear){
        return Archive::whereRaw('CAST(year AS UNSIGNED) BETWEEN ? AND ?', [$startYear, $endYear])
            ->orderByRaw('CAST(year AS UNSIGNED) DESC')
            ->get();
    }

    public function biography(){
        return view('website.biography');
    }

    public function exhibitions(){
        $solo_exhibitions = Exhibition::where('category', 'solo')
            ->orderBy('year', 'desc')
            ->get();
        
        $group_exhibitions = Exhibition::where('category', 'group')
            ->orderBy('year', 'desc')
            ->get();
        
        return view('website.exhibitions', compact('solo_exhibitions', 'group_exhibitions'));
    }

    public function articles(){
        $articles = Article::orderBy('date', 'desc')->get();
        return view('website.articles', compact('articles'));
    }

    public function article($slug){
        $article = Article::where('slug', $slug)->first();
        $articles = Article::where('slug', '!=', $slug)->orderBy('date', 'desc')->get();
        if (!$article) {
            abort(404);
        }
        return view('website.article', compact('article', 'articles'));
    }

    public function archive($startYear, $endYear, $slug){
        $archive = Archive::where('slug', $slug)->first();
        if (!$archive) {
            abort(404);
        }

        // Verificar que el archivo esté dentro del rango de años
        $archiveYear = (int) $archive->year;
        if ($archiveYear < $startYear || $archiveYear > $endYear) {
            abort(404);
        }

        // Obtener el siguiente y anterior archivo dentro del rango de años
        $next = Archive::whereRaw('CAST(year AS UNSIGNED) BETWEEN ? AND ?', [$startYear, $endYear])
            ->where(function($query) use ($archive) {
                $query->where('year', '>', $archive->year)
                      ->orWhere(function($q) use ($archive) {
                          $q->where('year', '=', $archive->year)
                            ->where('id', '>', $archive->id);
                      });
            })
            ->orderBy('year', 'asc')
            ->orderBy('id', 'asc')
            ->first();

        $prev = Archive::whereRaw('CAST(year AS UNSIGNED) BETWEEN ? AND ?', [$startYear, $endYear])
            ->where(function($query) use ($archive) {
                $query->where('year', '<', $archive->year)
                      ->orWhere(function($q) use ($archive) {
                          $q->where('year', '=', $archive->year)
                            ->where('id', '<', $archive->id);
                      });
            })
            ->orderBy('year', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        return view('website.archive', compact('archive', 'next', 'prev', 'startYear', 'endYear'));
    }
}
