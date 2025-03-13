<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Contact;
use App\Models\About;
use App\Models\Skills;
use App\Models\Resume;
class PortfolioController extends Controller
{
    public function index()
    {
        $portfolioItems = PortfolioItem::all(); // Fetch all portfolio items
        $services = Service::all();
        $testimonials = Testimonial::all();
        $contact = Contact::all();
        $about = About::first(); 
        $skills = Skills::all();
        $resumes = Resume::all();
        return view('welcome', compact('portfolioItems','services','testimonials','contact','about','skills','resumes'));
    }

    public function portfolioDetails()
    {
        return view('portfolio.details');
    }

    public function serviceDetails()
    {
        return view('services.details');
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