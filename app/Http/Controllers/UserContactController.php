<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class UserContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->route('contact.index')->with('success', 'Contact message created successfully.');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255', // Changed to nullable to match migration
            'message' => 'required|string|max:2000',
        ]);

        try {
            // Store in database
            Contact::create($validated);

            // Flash success message to session
            return redirect()->route('welcome') // Change 'home' to 'welcome' or the correct route name
                ->with('success', 'Your message has been sent successfully!');

        } catch (\Exception $e) {
            \Log::error('Contact save error: ' . $e->getMessage());
            return redirect()->route('welcome') // Change 'home' to 'welcome' or the correct route name
                ->with('error', 'Failed to send your message. Please try again later.')
                ->withInput(); // Preserve form input on error
        }
    }
}
