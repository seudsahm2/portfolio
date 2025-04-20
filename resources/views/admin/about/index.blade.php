@extends('layouts.admin')

@section('content')
    <h1>About Section</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($abouts->isEmpty())
        <p>No About records found.</p>
        <a href="{{ route('about.create') }}" class="btn btn-primary">Add About</a>
    @else
        @foreach ($abouts as $about)
            <div class="card mb-4">
                <div class="card-header">
                    <h2>{{ $about->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Birthday:</strong> {{ $about->birthday }}</p>
                    <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($about->birthday)->age }}</p>
                    <p><strong>City:</strong> {{ $about->city }}</p>
                    <p><strong>Email:</strong> {{ $about->email }}</p>
                    <p><strong>Website:</strong> {{ $about->website }}</p>
                    <p><strong>Phone:</strong> {{ $about->phone }}</p>
                    <p><strong>Degree:</strong> {{ $about->degree }}</p>
                    <p><strong>Description:</strong> {{ $about->description }}</p>
                    <p><strong>Objective:</strong> {{ $about->objective }}</p>
                    @if ($about->image_url)
                        <p><strong>Image:</strong></p>
                        <img src="{{ asset('storage/' . $about->image_url) }}" alt="About Image" width="200">
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('about.edit', $about->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('about.destroy', $about->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection