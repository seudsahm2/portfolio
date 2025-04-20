
@extends('layouts.admin')

@section('content')
    <h1>Awards</h1>
    <a href="{{ route('award.create') }}" class="btn btn-primary mb-3">Add Award</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Organization</th>
                <th>Date Given</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($awards as $award)
                <tr>
                    <td>{{ $award->id }}</td>
                    <td>{{ $award->title }}</td>
                    <td>{{ $award->organization }}</td>
                    <td>{{ $award->date_given ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('award.edit', $award->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('award.destroy', $award->id) }}" method="POST" style="display:inline;">
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