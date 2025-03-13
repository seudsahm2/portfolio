
@extends('layouts.admin')

@section('content')
    <h1>Edit Service</h1>
    <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $service->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $service->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" name="icon" id="icon" class="form-control" value="{{ $service->icon }}" required>
        </div>
        <div class="form-group">
            <label for="details_url">Details URL</label>
            <input type="file" name="details_url" id="details_url" class="form-control" value="{{ $service->details_url }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection