@extends('layouts.admin')

@section('content')
    <h1>Create Hero Section</h1>
    <form action="{{ route('hero.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Hero Section Image -->
        <div class="form-group">
            <label for="image">Hero Background Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <!-- Portfolio/Profile Image -->
        <div class="form-group">
            <label for="portfolio_image">Portfolio Profile Image</label>
            <input type="file" name="portfolio_image" id="portfolio_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
