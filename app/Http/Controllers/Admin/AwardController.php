<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::all();
        return view('admin.award.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.award.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_given' => 'nullable|date',
            'organization' => 'required|string|max:255',
        ]);

        Award::create($request->all());

        return redirect()->route('award.index')->with('success', 'Award added successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.award.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_given' => 'nullable|date',
            'organization' => 'required|string|max:255',
        ]);

        $award->update($request->all());

        return redirect()->route('award.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        $award->delete();

        return redirect()->route('award.index')->with('success', 'Award deleted successfully.');
    }
}