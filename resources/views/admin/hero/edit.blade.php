@extends('layouts.admin')

@section('content')
    <h1>Edit Hero Section</h1>
    <form action="{{ route('hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($hero->image)
                <img src="{{ asset('storage/' . $hero->image) }}" alt="Current Image" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection