@extends('layouts.admin')

@section('content')
    <h1>Add Experience</h1>
    <form action="{{ route('experience.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="organization">Organization</label>
            <input type="text" name="organization" id="organization" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Experience</button>
    </form>
@endsection