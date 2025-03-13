@extends('layouts.admin')

@section('content')
    <h1>Edit Portfolio Item</h1>
    <form action="{{ route('portfolio.update', $portfolioItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $portfolioItem->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $portfolioItem->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input type="file" name="image_url" id="image_url" class="form-control" value="{{ $portfolioItem->image_url }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ $portfolioItem->category }}" required>
        </div>
        <div class="form-group">
            <label for="details_url">Details URL</label>
            <input type="url" name="details_url" id="details_url" class="form-control" value="{{ $portfolioItem->details_url }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection