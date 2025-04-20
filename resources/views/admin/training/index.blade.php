@extends('layouts.admin')

@section('content')
    <h1>Trainings</h1>
    <a href="{{ route('training.create') }}" class="btn btn-primary mb-3">Add Training</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Organization</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainings as $training)
                <tr>
                    <td>{{ $training->id }}</td>
                    <td>{{ $training->title }}</td>
                    <td>{{ $training->organization }}</td>
                    <td>{{ $training->start_date ?? 'N/A' }}</td>
                    <td>{{ $training->end_date ?? 'Present' }}</td>
                    <td>
                        <a href="{{ route('training.edit', $training->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('training.destroy', $training->id) }}" method="POST" style="display:inline;">
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