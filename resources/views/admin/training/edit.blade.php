@extends('layouts.admin')

@section('content')
    <h1>Edit Training</h1>
    <form action="{{ route('training.update', $training->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Training Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $training->title }}" required>
        </div>
        <div class="form-group">
            <label for="organization">Organizing Organization</label>
            <input type="text" name="organization" id="organization" class="form-control" value="{{ $training->organization }}">
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $training->start_date }}">
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $training->end_date }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $training->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Training</button>
    </form>
@endsection