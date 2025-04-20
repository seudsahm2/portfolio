@extends('layouts.admin')

@section('content')
    <h1>Testimonials</h1>
    <a href="{{ route('testimonial.create') }}" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Image URL</th>
                <th>Quote</th>
                <th>Organization</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
                <tr>
                    <td>{{ $testimonial->name }}</td>
                    <td>{{ $testimonial->role }}</td>
                    <td>{{ $testimonial->image_url }}</td>
                    <td>{{ $testimonial->quote }}</td>
                    <td>{{ $testimonial->organization }}</td>
                    <td>{{ $testimonial->email }}</td>
                    <td>{{ $testimonial->phone }}</td>
                    <td>
                        <a href="{{ route('testimonial.edit', $testimonial->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('testimonial.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
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