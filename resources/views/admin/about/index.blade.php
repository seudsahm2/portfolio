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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($abouts as $about)
                    <tr>
                        <td>{{ $about->name }}</td>
                        <td>{{ $about->birthday }}</td>
                        <td>{{ \Carbon\Carbon::parse($about->birthday)->age }}</td>
                        <td>{{ $about->city }}</td>
                        <td>{{ $about->email }}</td>
                        <td>
                            <a href="{{ route('about.edit', $about->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('about.destroy', $about->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection