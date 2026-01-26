<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('order')->get();

        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        $availableIcons = SocialLink::getAvailableIcons();

        return view('admin.social-links.create', compact('availableIcons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'active' => 'boolean',
        ]);

        // Set the order if not provided
        if (empty($validated['order'])) {
            $maxOrder = SocialLink::max('order') ?? 0;
            $validated['order'] = $maxOrder + 1;
        }

        SocialLink::create($validated);

        return redirect()->route('social-links.index')
            ->with('success', 'Social link has been created successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        $availableIcons = SocialLink::getAvailableIcons();

        return view('admin.social-links.edit', compact('socialLink', 'availableIcons'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'active' => 'boolean',
        ]);

        $socialLink->update($validated);

        return redirect()->route('social-links.index')
            ->with('success', 'Social link has been updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('social-links.index')
            ->with('success', 'Social link has been deleted successfully.');
    }

    public function toggle(SocialLink $socialLink)
    {
        $socialLink->active = ! $socialLink->active;
        $socialLink->save();

        return redirect()->route('social-links.index')
            ->with('success', 'Social link status has been updated successfully.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'required|integer|min:0',
        ]);

        foreach ($data['orders'] as $id => $order) {
            $socialLink = SocialLink::find($id);
            if ($socialLink) {
                $socialLink->order = $order;
                $socialLink->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
