<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        // Búsqueda por título o publicación
        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->get('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('publication', 'LIKE', "%{$search}%");
        }

        $articles = $query->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'publication' => 'nullable|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Generar slug único
        $slug = Str::slug($request->title);
        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-'.time();
        }
        $validated['slug'] = $slug;

        // Procesar imagen si existe
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$slug.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/articles'), $imageName);
            $validated['image'] = 'images/articles/'.$imageName;
        }

        Article::create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'The article has been created successfully.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'publication' => 'nullable|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Generar slug si el título cambió
        if ($request->title !== $article->title) {
            $slug = Str::slug($request->title);
            if (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug .= '-'.time();
            }
            $validated['slug'] = $slug;
        }

        // Procesar nueva imagen si existe
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($article->image && file_exists(public_path($article->image))) {
                unlink(public_path($article->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.($validated['slug'] ?? $article->slug).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/articles'), $imageName);
            $validated['image'] = 'images/articles/'.$imageName;
        }

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'The article has been updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Eliminar imagen si existe
        if ($article->image && file_exists(public_path($article->image))) {
            unlink(public_path($article->image));
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'The article has been deleted successfully.');
    }
}
