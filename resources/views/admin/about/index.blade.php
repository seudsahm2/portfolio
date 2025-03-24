@extends('layouts.admin')

@section('content')
    <h1>About Section</h1>
    {{-- Check if there is no About record --}}
    @if($abouts->isEmpty())
        <a href="{{ route('about.create') }}" class="btn btn-primary">Add About</a>
    @else
        {{-- Display the About record in a vertical card layout --}}
        <div class="card mt-4">
            <!-- Card Header with the About name -->
            <div class="card-header">
                <h2>{{ $abouts->first()->name }}</h2>
            </div>
            <!-- Card Body with details listed vertically -->
            <div class="card-body">
                <p><strong>Birthday:</strong> {{ $abouts->first()->birthday }}</p>
                <p><strong>Website:</strong> {{ $abouts->first()->website }}</p>
                <p><strong>Phone:</strong> {{ $abouts->first()->phone }}</p>
                <p><strong>City:</strong> {{ $abouts->first()->city }}</p>
                <p><strong>Age:</strong> {{ $abouts->first()->age }}</p>
                <p><strong>Degree:</strong> {{ $abouts->first()->degree }}</p>
                <p><strong>Email:</strong> {{ $abouts->first()->email }}</p>
                <p><strong>Freelance:</strong> {{ $abouts->first()->freelance ? 'Yes' : 'No' }}</p>
                <p><strong>Description:</strong></p>
                <p>{{ $abouts->first()->description }}</p>
                {{-- Display the image if available --}}
                @if($abouts->first()->image_url)
                    <div class="text-center mt-3">
                        <img src="{{ asset('storage/' . $abouts->first()->image_url) }}" alt="About Image" class="img-fluid rounded" style="max-width: 300px;">
                    </div>
                @endif
            </div>
            <!-- Card Footer with action buttons -->
            <div class="card-footer">
                <a href="{{ route('about.edit', $abouts->first()->id) }}" class="btn btn-warning">Update About</a>
                <form action="{{ route('about.destroy', $abouts->first()->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the About record?')">Delete</button>
                </form>
            </div>
        </div>
    @endif
@endsection
