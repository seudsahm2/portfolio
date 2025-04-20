
@extends('layouts.admin')

@section('content')
    <h1>Certificates</h1>
    <a href="{{ route('certificate.create') }}" class="btn btn-primary mb-3">Add Certificate</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Organization</th>
                <th>Awarded Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->id }}</td>
                    <td>{{ $certificate->title }}</td>
                    <td>{{ $certificate->organization }}</td>
                    <td>{{ $certificate->awarded_date ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('certificate.edit', $certificate->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('certificate.destroy', $certificate->id) }}" method="POST" style="display:inline;">
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