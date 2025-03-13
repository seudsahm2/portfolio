<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skills::all();
        return view('admin.skill.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skill.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        Skills::create($request->all());

        return redirect()->route('skill.index')->with('success', 'Skill created successfully.');
    }

    public function edit(Skills $skill)
    {
        return view('admin.skill.edit', compact('skill'));
    }

    public function update(Request $request, Skills $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        $skill->update($request->all());

        return redirect()->route('skill.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skills $skill)
    {
        $skill->delete();

        return redirect()->route('skill.index')->with('success', 'Skill deleted successfully.');
    }
}