<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $query = Archive::query();

        // Búsqueda por título o categoría
        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->get('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('category', 'LIKE', "%{$search}%");
        }

        $archives = $query->orderBy('year', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.archives.index', compact('archives'));
    }

    public function create()
    {
        return view('admin.archives.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'category' => 'required|string|max:100',
            'format' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'year' => 'required|integer|min:1900|max:'.date('Y'),
            'height' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0',
            'length' => 'nullable|numeric|min:0',
        ]);

        // Generar slug único
        $slug = Str::slug($request->title);
        if (Archive::where('slug', $slug)->exists()) {
            $slug .= '-'.time();
        }
        $validated['slug'] = $slug;

        // Generar archiveid único
        $validated['archiveid'] = 'ARCH-'.time().'-'.rand(1000, 9999);

        // Procesar imagen si existe
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$slug.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/archives'), $imageName);
            $validated['image'] = 'images/archives/'.$imageName;
        }

        Archive::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'The archive has been created successfully.');
    }

    public function edit(Archive $archive)
    {
        return view('admin.archives.edit', compact('archive'));
    }

    public function update(Request $request, Archive $archive)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'category' => 'required|string|max:100',
            'format' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'year' => 'required|integer|min:1900|max:'.date('Y'),
            'height' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0',
            'length' => 'nullable|numeric|min:0',
        ]);

        // Generar slug si el título cambió
        if ($request->title !== $archive->title) {
            $slug = Str::slug($request->title);
            if (Archive::where('slug', $slug)->where('id', '!=', $archive->id)->exists()) {
                $slug .= '-'.time();
            }
            $validated['slug'] = $slug;
        }

        // Procesar nueva imagen si existe
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($archive->image && file_exists(public_path($archive->image))) {
                unlink(public_path($archive->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.($validated['slug'] ?? $archive->slug).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/archives'), $imageName);
            $validated['image'] = 'images/archives/'.$imageName;
        }

        $archive->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'The archive has been updated successfully.');
    }

    public function destroy(Archive $archive)
    {
        // Eliminar imagen si existe
        if ($archive->image && file_exists(public_path($archive->image))) {
            unlink(public_path($archive->image));
        }

        $archive->delete();

        return redirect()->route('dashboard')
            ->with('success', 'The archive has been deleted successfully.');
    }
}
