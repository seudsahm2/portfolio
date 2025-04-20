
@extends('layouts.admin')

@section('content')
    <h1>Languages</h1>
    <a href="{{ route('language.create') }}" class="btn btn-primary mb-3">Add Language</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Language</th>
                <th>Proficiency</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($languages as $language)
                <tr>
                    <td>{{ $language->id }}</td>
                    <td>{{ $language->name }}</td>
                    <td>{{ $language->proficiency }}</td>
                    <td>
                        <a href="{{ route('language.edit', $language->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('language.destroy', $language->id) }}" method="POST" style="display:inline;">
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