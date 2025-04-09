@extends('layouts.admin')

@section('content')
    <h1>Edit Resume Item</h1>
    <form action="{{ route('resume.update', $resume->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Job Title or Degree Name</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $resume->title }}" placeholder="e.g., Software Engineer, Bachelor of Science in Computer Science" required>
        </div>
        <div class="form-group">
            <label for="subtitle">Company or Institution Name</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $resume->subtitle }}" placeholder="e.g., Google, Harvard University">
        </div>
        <div class="form-group">
            <label for="type">Category (e.g., Work Experience, Education, Certifications)</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $resume->type }}" placeholder="e.g., Work Experience, Education, Certifications" required>
        </div>
        <div class="form-group">
            <label for="description">Description or Responsibilities</label>
            <textarea name="description" id="description" class="form-control" rows="5" placeholder="e.g., Developed web applications using Laravel and Vue.js">{{ $resume->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $resume->start_date }}" placeholder="e.g., 2020-01-01">
        </div>
        <div class="form-group">
            <label for="end_date">End Date (leave blank if ongoing)</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $resume->end_date }}" placeholder="e.g., 2022-12-31">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $resume->location }}" placeholder="e.g., San Francisco, CA">
        </div>
        <div class="form-group">
            <label for="contact">Reference or Contact Person (optional)</label>
            <input type="text" name="contact" id="contact" class="form-control" value="{{ $resume->contact }}" placeholder="e.g., Jane Smith, HR Manager">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection