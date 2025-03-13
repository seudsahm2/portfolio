
@extends('layouts.admin')

@section('content')
    <h1>Services</h1>
    <a href="{{ route('service.create') }}" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Icon</th>
                <th>Details URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->title }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->icon }}</td>
                    <td>{{ $service->details_url }}</td>
                    <td>
                        <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline;">
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