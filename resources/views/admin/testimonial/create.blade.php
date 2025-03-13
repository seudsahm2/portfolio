
@extends('layouts.admin')

@section('content')
    <h1>Create Testimonial</h1>
    <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" name="role" id="role" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input type="file" name="image_url" id="image_url" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quote">Quote</label>
            <textarea name="quote" id="quote" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection