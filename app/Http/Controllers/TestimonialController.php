<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all(); // Fetch all testimonials
        return view('welcome', compact('testimonials'));
    }
}
