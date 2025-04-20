<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {
        Log::info('Store method called');

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15|regex:/^\\+?[0-9\\s\\-]+$/',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quote' => 'required|string',
        ]);

        Log::info('Validation passed');

        // Build the data array with all fields except image_url
        $data = [
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'organization' => $request->input('organization'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'quote' => $request->input('quote'),
        ];

        // Handle image upload
        if ($request->hasFile('image_url')) {
            Log::info('Image file found');
            $imagePath = $request->file('image_url')->store('images', 'public');
            Log::info('Image stored at: ' . $imagePath);
            $data['image_url'] = $imagePath;
        } else {
            Log::info('No image file found');
        }

        // Create the testimonial with the explicit data array
        $testimonial = Testimonial::create($data);

        Log::info('Testimonial created: ', $testimonial->toArray());

        return redirect()->route('testimonial.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        Log::info('Update method called');

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15|regex:/^\\+?[0-9\\s\\-]+$/',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quote' => 'required|string',
        ]);

        Log::info('Validation passed');

        // Build the data array with all fields except image_url
        $data = [
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'organization' => $request->input('organization'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'quote' => $request->input('quote'),
        ];

        // Handle image upload
        if ($request->hasFile('image_url')) {
            Log::info('Image file found');
            // Delete the old image if it exists
            if ($testimonial->image_url) {
                Storage::disk('public')->delete($testimonial->image_url);
                Log::info('Old image deleted: ' . $testimonial->image_url);
            }
            $imagePath = $request->file('image_url')->store('images', 'public');
            Log::info('New image stored at: ' . $imagePath);
            $data['image_url'] = $imagePath;
        } else {
            Log::info('No image file found');
            // Keep the old image if no new one is uploaded
            $data['image_url'] = $testimonial->image_url;
        }

        // Update the testimonial with the explicit data array
        $testimonial->update($data);

        Log::info('Testimonial updated: ', $testimonial->toArray());

        return redirect()->route('testimonial.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Optionally delete the image when destroying the testimonial
        if ($testimonial->image_url) {
            Storage::disk('public')->delete($testimonial->image_url);
        }
        $testimonial->delete();

        return redirect()->route('testimonial.index')->with('success', 'Testimonial deleted successfully.');
    }
}