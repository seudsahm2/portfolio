@extends('layouts.admin')

@section('content')
    <h1>Edit Experience</h1>
    <form action="{{ route('experience.update', $experience->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="organization">Organization</label>
            <input type="text" name="organization" id="organization" class="form-control" value="{{ $experience->organization }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $experience->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $experience->end_date }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $experience->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Experience</button>
    </form>
@endsection