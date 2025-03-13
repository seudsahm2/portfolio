<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all(); // Fetch all contacts
        return view('welcome', compact('contacts'));
    }
}
