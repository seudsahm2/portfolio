<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Resume::all();
        return view('admin.resume.index', compact('resumes'));
    }

    public function create()
    {
        return view('admin.resume.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        Resume::create($request->all());

        return redirect()->route('resume.index')->with('success', 'Resume item created successfully.');
    }

    public function edit(Resume $resume)
    {
        return view('admin.resume.edit', compact('resume'));
    }

    public function update(Request $request, Resume $resume)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        $resume->update($request->all());

        return redirect()->route('resume.index')->with('success', 'Resume item updated successfully.');
    }

    public function destroy(Resume $resume)
    {
        $resume->delete();

        return redirect()->route('resume.index')->with('success', 'Resume item deleted successfully.');
    }
}