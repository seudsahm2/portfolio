
@extends('layouts.admin')

@section('content')
    <h1>Add Award</h1>
    <form action="{{ route('award.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Award Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="organization">Organization</label>
            <input type="text" name="organization" id="organization" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_given">Date Given</label>
            <input type="date" name="date_given" id="date_given" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Award</button>
    </form>
@endsection