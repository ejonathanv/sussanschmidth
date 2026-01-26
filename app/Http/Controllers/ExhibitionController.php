<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExhibitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Exhibition::query();

        // Búsqueda por título o categoría
        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->get('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('category', 'LIKE', "%{$search}%");
        }

        $exhibitions = $query->orderBy('year', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.exhibitions.index', compact('exhibitions'));
    }

    public function create()
    {
        return view('admin.exhibitions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_two' => 'nullable|string',
            'place' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Procesar imagen si existe
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/exhibitions'), $imageName);
            $validated['image'] = 'images/exhibitions/'.$imageName;
        }

        Exhibition::create($validated);

        return redirect()->route('exhibitions.index')
            ->with('success', 'The exhibition has been created successfully.');
    }

    public function edit(Exhibition $exhibition)
    {
        return view('admin.exhibitions.edit', compact('exhibition'));
    }

    public function update(Request $request, Exhibition $exhibition)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_two' => 'nullable|string',
            'place' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Procesar nueva imagen si existe
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($exhibition->image && file_exists(public_path($exhibition->image))) {
                unlink(public_path($exhibition->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/exhibitions'), $imageName);
            $validated['image'] = 'images/exhibitions/'.$imageName;
        }

        $exhibition->update($validated);

        return redirect()->route('exhibitions.index')
            ->with('success', 'The exhibition has been updated successfully.');
    }

    public function destroy(Exhibition $exhibition)
    {
        // Eliminar imagen si existe
        if ($exhibition->image && file_exists(public_path($exhibition->image))) {
            unlink(public_path($exhibition->image));
        }

        $exhibition->delete();

        return redirect()->route('exhibitions.index')
            ->with('success', 'The exhibition has been deleted successfully.');
    }
}
