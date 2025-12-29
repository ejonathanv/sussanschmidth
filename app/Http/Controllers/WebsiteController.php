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
}
