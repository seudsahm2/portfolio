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
use App\Models\Profession;
use App\Models\Language;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Training;
use App\Models\Award;

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
        $professions = Profession::all();
        $languages = Language::all();
        $experiences = Experience::latest()->take(5)->get();
        $certificates = Certificate::all(); // Add this line
        $trainings = Training::latest()->take(5)->get(); // Add this line
        $awards = Award::all(); // Add this line
        return view('welcome', compact('testimonials', 'about', 'skills', 'resumes', 'hero', 'educations', 'professions', 'languages', 'experiences', 'certificates', 'trainings', 'awards'));
    }

    public function allExperiences()
    {
        $experiences = Experience::latest()->get(); // Fetch all experiences
        return view('all-experiences', compact('experiences'));
    }

    public function allTrainings()
    {
        $trainings = Training::latest()->get(); // Fetch all trainings
        return view('all-trainings', compact('trainings'));
    }
}