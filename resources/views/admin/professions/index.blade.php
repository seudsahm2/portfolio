@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Professions</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('professions.create') }}" class="btn btn-primary mb-3">Add Profession</a>

        @if($professions->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Profession Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($professions as $profession)
                            <tr>
                                <td>{{ $profession->name }}</td>
                                <td>
                                    <a href="{{ route('professions.edit', $profession->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('professions.destroy', $profession->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this profession?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No professions available.</p>
        @endif
    </div>
@endsection