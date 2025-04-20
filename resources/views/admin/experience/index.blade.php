@extends('layouts.admin')

@section('content')
    <h1>Experiences</h1>
    <a href="{{ route('experience.create') }}" class="btn btn-primary mb-3">Add Experience</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Organization</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($experiences as $experience)
                <tr>
                    <td>{{ $experience->id }}</td>
                    <td>{{ $experience->organization }}</td>
                    <td>{{ $experience->start_date }}</td>
                    <td>{{ $experience->end_date ?? 'Present' }}</td>
                    <td>
                        <a href="{{ route('experience.edit', $experience->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('experience.destroy', $experience->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection