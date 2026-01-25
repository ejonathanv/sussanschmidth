<?php

namespace App\Http\Controllers;

use App\Models\SmallFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SmallFormatController extends Controller
{
    public function index(Request $request)
    {
        $query = SmallFormat::query();

        // Búsqueda por título o categoría
        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->get('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('category', 'LIKE', "%{$search}%");
        }

        $smallFormats = $query->orderBy('year', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.small-formats.index', compact('smallFormats'));
    }

    public function create()
    {
        return view('admin.small-formats.create');
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
            'digital_info' => 'nullable|string|max:2000',
            'location' => 'nullable|string|max:255',
            'year' => 'required|integer|min:1900|max:'.date('Y'),
            'height' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0',
            'length' => 'nullable|numeric|min:0',
        ]);

        // Generar slug único
        $slug = Str::slug($request->title);
        if (SmallFormat::where('slug', $slug)->exists()) {
            $slug .= '-'.time();
        }
        $validated['slug'] = $slug;

        // Generar smallformatid único
        $validated['smallformatid'] = 'SMF-'.time().'-'.rand(1000, 9999);

        // Procesar imagen si existe
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$slug.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/small-formats'), $imageName);
            $validated['image'] = 'images/small-formats/'.$imageName;
        }

        SmallFormat::create($validated);

        return redirect()->route('small-formats.index')
            ->with('success', 'The Small Format has been created successfully.');
    }

    public function edit(SmallFormat $smallFormat)
    {
        return view('admin.small-formats.edit', compact('smallFormat'));
    }

    public function update(Request $request, SmallFormat $smallFormat)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'category' => 'required|string|max:100',
            'format' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:255',
            'digital_info' => 'nullable|string|max:2000',
            'location' => 'nullable|string|max:255',
            'year' => 'required|integer|min:1900|max:'.date('Y'),
            'height' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0',
            'length' => 'nullable|numeric|min:0',
        ]);

        // Generar slug si el título cambió
        if ($request->title !== $smallFormat->title) {
            $slug = Str::slug($request->title);
            if (SmallFormat::where('slug', $slug)->where('id', '!=', $smallFormat->id)->exists()) {
                $slug .= '-'.time();
            }
            $validated['slug'] = $slug;
        }

        // Procesar nueva imagen si existe
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($smallFormat->image && file_exists(public_path($smallFormat->image))) {
                unlink(public_path($smallFormat->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.($validated['slug'] ?? $smallFormat->slug).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/small-formats'), $imageName);
            $validated['image'] = 'images/small-formats/'.$imageName;
        }

        $smallFormat->update($validated);

        return redirect()->route('small-formats.index')
            ->with('success', 'The Small Format has been updated successfully.');
    }

    public function destroy(SmallFormat $smallFormat)
    {
        // Eliminar imagen si existe
        if ($smallFormat->image && file_exists(public_path($smallFormat->image))) {
            unlink(public_path($smallFormat->image));
        }

        $smallFormat->delete();

        return redirect()->route('small-formats.index')
            ->with('success', 'The Small Format has been deleted successfully.');
    }
}
