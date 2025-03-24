
@extends('layouts.admin')

@section('content')
    <h1>Create Hero Section</h1>
    <form action="{{ route('hero.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection