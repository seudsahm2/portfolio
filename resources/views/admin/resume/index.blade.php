
@extends('layouts.admin')

@section('content')
    <h1>Resume Items</h1>
    <a href="{{ route('resume.create') }}" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Type</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resumes as $resume)
                <tr>
                    <td>{{ $resume->title }}</td>
                    <td>{{ $resume->subtitle }}</td>
                    <td>{{ $resume->type }}</td>
                    <td>{{ $resume->description }}</td>
                    <td>{{ $resume->start_date }}</td>
                    <td>{{ $resume->end_date }}</td>
                    <td>{{ $resume->location }}</td>
                    <td>{{ $resume->contact }}</td>
                    <td>
                        <a href="{{ route('resume.edit', $resume->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('resume.destroy', $resume->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection