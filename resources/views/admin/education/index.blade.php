@extends('layouts.admin')

@section('content')
    <h1>Education</h1>
    <a href="{{ route('education.create') }}" class="btn btn-primary mb-3">Add New Education</a>
    
    @if($educations->isEmpty())
        <div class="alert alert-info">No education entries found.</div>
    @else
        <div class="list-group">
            @foreach($educations as $education)
                <div class="list-group-item mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4>{{ $education->title }}</h4>
                            <h5>{{ $education->subtitle }}</h5>
                            <p class="mb-1">{{ $education->location }}</p>
                            <small>
                                {{ $education->start_date->format('j F Y') }} - 
                                {{ $education->end_date ? $education->end_date->format('j F Y') : 'Present' }}
                            </small>
                            @if($education->description)
                                <p class="mt-2">{{ $education->description }}</p>
                            @endif
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('education.edit', $education->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('education.destroy', $education->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection