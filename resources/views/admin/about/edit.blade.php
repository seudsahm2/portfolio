
@extends('layouts.admin')

@section('content')
    <h1>Edit About Section</h1>
    <form action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $about->name }}" required>
        </div>
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" name="birthday" id="birthday" class="form-control" value="{{ $about->birthday }}" required>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" id="website" class="form-control" value="{{ $about->website }}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $about->phone }}" required>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ $about->city }}" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ $about->age }}" required>
        </div>
        <div class="form-group">
            <label for="degree">Degree</label>
            <input type="text" name="degree" id="degree" class="form-control" value="{{ $about->degree }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $about->email }}" required>
        </div>
        <div class="form-group">
            <label for="freelance">Freelance</label>
            <select name="freelance" id="freelance" class="form-control" required>
                <option value="1" {{ $about->freelance ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$about->freelance ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $about->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input type="file" name="image_url" id="image_url" class="form-control" value="{{ $about->image_url }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection