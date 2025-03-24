<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Contact;
use App\Models\About;
use App\Models\Skills;
use App\Models\Resume;
use App\Models\Hero;
class PortfolioController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        $contact = Contact::all();
        $about = About::first(); 
        $skills = Skills::all();
        $resumes = Resume::all();
        $hero = Hero::first();
        return view('welcome', compact('testimonials','contact','about','skills','resumes','hero'));
    }


    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
    }
}