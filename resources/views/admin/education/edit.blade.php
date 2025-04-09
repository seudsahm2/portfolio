@extends('layouts.admin')

@section('content')
    <h1>Edit Education</h1>
    <form action="{{ route('education.update', $education->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Degree Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $education->title }}" required>
        </div>
        <div class="form-group">
            <label for="subtitle">University Name</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $education->subtitle }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $education->location }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $education->start_date->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" 
                value="{{ $education->end_date ? $education->end_date->format('Y-m-d') : '' }}">
        </div>
        <div class="form-group">
            <label for="grade">Grade</label>
            <input type="number" step="0.01" name="grade" id="grade" class="form-control" value="{{ $education->grade }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $education->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Education</button>
    </form>
@endsection