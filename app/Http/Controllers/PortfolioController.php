<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Contact;
use App\Models\About;
use App\Models\Skills;
use App\Models\Resume;
use App\Models\Hero;
use App\Models\Education;

class PortfolioController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        $about = About::first();
        $skills = Skills::all();
        $resumes = Resume::all();
        $hero = Hero::first();
        $educations = Education::all();
        return view('welcome', compact('testimonials', 'about', 'skills', 'resumes', 'hero', 'educations'));
    }

}