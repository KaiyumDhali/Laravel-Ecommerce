<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index() {
        $partners = Partner::latest()->get();
        return view('admin.partner.index', compact('partners'));
    }

    public function create() {
        return view('admin.partner.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'partner_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/partners'), $imageName);
        }

        Partner::create([
            'name' => $request->name,
            'link' => $request->link,
            'image' => 'uploads/partners/' . $imageName,
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner added successfully.');
    }

    public function edit(Partner $partner) {
        return view('admin.partner.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner) {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'partner_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/partners'), $imageName);
            $partner->image = 'uploads/partners/' . $imageName;
        }

        $partner->name = $request->name;
        $partner->link = $request->link;
        $partner->save();

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner) {
        $partner->delete();
        return back()->with('success', 'Partner deleted successfully.');
    }
}
