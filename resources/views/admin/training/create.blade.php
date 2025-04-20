
@extends('layouts.admin')

@section('content')
    <h1>Add Training</h1>
    <form action="{{ route('training.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Training Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="organization">Organizing Organization</label>
            <input type="text" name="organization" id="organization" class="form-control">
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Training</button>
    </form>
@endsection