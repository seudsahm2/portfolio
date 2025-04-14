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
            'birthday' => 'required|date|before:today', // Ensure the birthday is a past date
            'website' => 'nullable|url',
            'phone' => 'required|string|max:15|regex:/^\+?[0-9\s\-]+$/', // Validate phone number format
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'degree' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'freelance' => 'required|boolean',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_info' => 'nullable|string',
        ]);
    
        Log::info('Validation passed');
    
        // Create a data array with all fields except image_url
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
            'additional_info' => $request->input('additional_info'),
        ];
    
        // Handle image upload separately
        if ($request->hasFile('image_url')) {
            Log::info('Image file found');
            // Store the image and get its path
            $imagePath = $request->file('image_url')->store('images', 'public');
            Log::info('Image stored at: ' . $imagePath);
            // Set image_url in data
            $data['image_url'] = $imagePath;
        } else {
            Log::info('No image file found');
            // If no image is uploaded, set image_url to null (or leave out since it’s nullable)
        }
    
        // Create the model with the explicit data array
        $about = About::create($data);
    
        Log::info('About section created: ', $about->toArray());
    
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
            'birthday' => 'required|date|before:today', // Ensure the birthday is a past date
            'website' => 'nullable|url',
            'phone' => 'required|string|max:15|regex:/^\+?[0-9\s\-]+$/', // Validate phone number format
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'degree' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'freelance' => 'required|boolean',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_info' => 'nullable|string',
        ]);
    
        Log::info('Validation passed');
    
        // Create a data array with all fields except image_url
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
            'additional_info' => $request->input('additional_info'),
        ];
    
        // Handle image upload separately
        if ($request->hasFile('image_url')) {
            Log::info('Image file found');
            // Delete the old image if it exists
            if ($about->image_url) {
                Storage::disk('public')->delete($about->image_url);
                Log::info('Old image deleted: ' . $about->image_url);
            }
            // Store the new image and get its path
            $imagePath = $request->file('image_url')->store('images', 'public');
            Log::info('New image stored at: ' . $imagePath);
            // Set image_url in data
            $data['image_url'] = $imagePath;
        } else {
            Log::info('No image file found');
            // Keep the old image
            $data['image_url'] = $about->image_url;
        }
    
        // Update the model with the explicit data array
        $about->update($data);
    
        Log::info('About section updated: ', $about->toArray());
    
        return redirect()->route('about.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(About $about)
    {
        $about->delete();

        return redirect()->route('about.index')->with('success', 'About section deleted successfully.');
    }
}