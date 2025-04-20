<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        Log::info('Store method called');

        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date|before:today',
            'website' => 'nullable|url',
            'phone' => 'required|string|max:15|regex:/^\\+?[0-9\\s\\-]+$/',
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'degree' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'freelance' => 'required|boolean',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'objective' => 'nullable|string',
        ]);

        Log::info('Validation passed', $request->all());

        $data = [
            'name' => $request->input('name'),
            'birthday' => $request->input('birthday'),
            'website' => $request->input('website'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'age' => $request->input('age'),
            'degree' => $request->input('degree'),
            'email' => $request->input('email'),
            'freelance' => $request->input('freelance'),
            'description' => $request->input('description'),
            'objective' => $request->input('objective'),
        ];

        if ($request->hasFile('image_url')) {
            Log::info('Image file found');
            $imagePath = $request->file('image_url')->store('images', 'public');
            Log::info('Image stored at: ' . $imagePath);
            $data['image_url'] = $imagePath;
        } else {
            Log::info('No image file found');
        }

        try {
            $about = About::create($data);
            Log::info('About section created successfully', $about->toArray());
        } catch (\Exception $e) {
            Log::error('Error creating About section: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create About section. Please try again.');
        }

        return redirect()->route('about.index')->with('success', 'About section created successfully.');
    }

    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        Log::info('Update method called');

        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date|before:today',
            'website' => 'nullable|url',
            'phone' => 'required|string|max:15|regex:/^\\+?[0-9\\s\\-]+$/',
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'degree' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'freelance' => 'required|boolean',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'objective' => 'nullable|string',
        ]);

        Log::info('Validation passed', $request->all());

        $data = [
            'name' => $request->input('name'),
            'birthday' => $request->input('birthday'),
            'website' => $request->input('website'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'age' => $request->input('age'),
            'degree' => $request->input('degree'),
            'email' => $request->input('email'),
            'freelance' => $request->input('freelance'),
            'description' => $request->input('description'),
            'objective' => $request->input('objective'),
        ];

        if ($request->hasFile('image_url')) {
            Log::info('Image file found');
            if ($about->image_url) {
                Storage::disk('public')->delete($about->image_url);
                Log::info('Old image deleted: ' . $about->image_url);
            }
            $imagePath = $request->file('image_url')->store('images', 'public');
            Log::info('New image stored at: ' . $imagePath);
            $data['image_url'] = $imagePath;
        } else {
            Log::info('No image file found');
            $data['image_url'] = $about->image_url;
        }

        try {
            $about->update($data);
            Log::info('About section updated successfully', $about->toArray());
        } catch (\Exception $e) {
            Log::error('Error updating About section: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update About section. Please try again.');
        }

        return redirect()->route('about.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(About $about)
    {
        $about->delete();

        return redirect()->route('about.index')->with('success', 'About section deleted successfully.');
    }
}