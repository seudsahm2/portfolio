<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'website' => 'nullable|url',
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'degree' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'freelance' => 'required|boolean',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        About::create($request->all());

        return redirect()->route('about.index')->with('success', 'About section created successfully.');
    }

    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'website' => 'nullable|url',
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'degree' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'freelance' => 'required|boolean',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $about->update($request->all());

        return redirect()->route('about.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(About $about)
    {
        $about->delete();

        return redirect()->route('about.index')->with('success', 'About section deleted successfully.');
    }
}