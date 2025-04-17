<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;

class Professions extends Controller
{
    public function index()
    {
        $professions = Profession::all();
        return view('admin.professions.index', compact('professions'));
    }

    public function create()
    {
        return view('admin.professions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:professions',
        ]);

        Profession::create($request->only('name'));

        return redirect()->route('professions.index')->with('success', 'Profession added successfully.');
    }

    public function edit(Profession $profession)
    {
        return view('admin.professions.edit', compact('profession'));
    }

    public function update(Request $request, Profession $profession)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:professions,name,' . $profession->id,
        ]);

        $profession->update($request->only('name'));

        return redirect()->route('professions.index')->with('success', 'Profession updated successfully.');
    }

    public function destroy(Profession $profession)
    {
        $profession->delete();

        return redirect()->route('professions.index')->with('success', 'Profession deleted successfully.');
    }
}
