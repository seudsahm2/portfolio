<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\About;
use App\Models\Skills;
use Illuminate\Support\Facades\Storage; // Import Storage facade to manage file storage

class HeroController extends Controller
{
    public function index()
    {
        $hero = Hero::all();
        $about = About::first(); // Define $about
        $skill = Skills::first(); // Define $skill, adjust as needed
        return view('admin.hero.index', compact('hero', 'about', 'skill'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $request->merge(['image' => $imagePath]);
        }

        Hero::create($request->all());

        return redirect()->route('hero.index')->with('success', 'Hero section created successfully.');
    }

    public function edit(Hero $hero)
    {
    
        return view('admin.hero.edit', compact('hero'));
    } 

    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Match $fillable
        ]);
    
        $data = [];
        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }
    
        $hero->update($data);
        return redirect()->route('hero.index')->with('success', 'Hero updated successfully.');
    }

    public function destroy()
    {
        $hero->delete();

        return redirect()->route('hero.index')->with('success', 'hero deleted successfully.');
    }
}
