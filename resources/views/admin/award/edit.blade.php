
@extends('layouts.admin')

@section('content')
    <h1>Edit Award</h1>
    <form action="{{ route('award.update', $award->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Award Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $award->title }}" required>
        </div>
        <div class="form-group">
            <label for="organization">Organization</label>
            <input type="text" name="organization" id="organization" class="form-control" value="{{ $award->organization }}" required>
        </div>
        <div class="form-group">
            <label for="date_given">Date Given</label>
            <input type="date" name="date_given" id="date_given" class="form-control" value="{{ $award->date_given }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $award->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Award</button>
    </form>
@endsection