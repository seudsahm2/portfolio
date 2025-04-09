<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Add this import

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::all();
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                Rule::when($request->filled('end_date'), 'after:start_date')
            ],
            'grade' => 'required|numeric|between:0,4.00',
            'description' => 'nullable|string',
        ], [
            'end_date.after' => 'The end date must be after the start date.',
            'start_date.date_format' => 'Start date format must be YYYY-MM-DD',
            'end_date.date_format' => 'End date format must be YYYY-MM-DD',
        ]);
        $validated['end_date'] = $validated['end_date'] ?? null;
        Education::create($validated);

        return redirect()->route('education.index')->with('success', 'Education added successfully');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                Rule::when($request->start_date, 'after:start_date')
            ],
            'grade' => 'required|numeric|between:0,4.00',
            'description' => 'nullable|string',
        ], [
            'end_date.after' => 'The end date must be after the start date.',
            'start_date.date_format' => 'Start date format must be YYYY-MM-DD',
            'end_date.date_format' => 'End date format must be YYYY-MM-DD',
        ]);
        $validated['end_date'] = $validated['end_date'] ?? null;
        $education->update($validated);

        return redirect()->route('education.index')->with('success', 'Education updated successfully');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('education.index')->with('success', 'Education deleted successfully');
    }
}