<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('admin.certificate.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'description' => 'required|string',
            'awarded_date' => 'nullable|date',
        ]);

        Certificate::create($request->all());

        return redirect()->route('certificate.index')->with('success', 'Certificate added successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificate.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'description' => 'required|string',
            'awarded_date' => 'nullable|date',
        ]);

        $certificate->update($request->all());

        return redirect()->route('certificate.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificate.index')->with('success', 'Certificate deleted successfully.');
    }
}