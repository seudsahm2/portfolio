@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Hero Section</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Show existing image -->
        @if($hero->image)
            <div class="mb-3">
                <label>Current Background Image:</label><br>
                <img src="{{ asset('storage/' . $hero->image) }}" width="200">
            </div>
        @endif

        <!-- Image upload -->
        <div class="mb-3">
            <label for="image">Update Background Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <!-- Show existing portfolio image -->
        @if($hero->portfolio_image)
            <div class="mb-3">
                <label>Current Portfolio Image:</label><br>
                <img src="{{ asset('storage/' . $hero->portfolio_image) }}" width="200">
            </div>
        @endif

        <!-- Portfolio Image upload -->
        <div class="mb-3">
            <label for="portfolio_image">Update Portfolio Image</label>
            <input type="file" class="form-control" name="portfolio_image" id="portfolio_image">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Hero</button>
    </form>
</div>
@endsection
