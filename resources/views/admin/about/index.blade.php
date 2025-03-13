
@extends('layouts.admin')

@section('content')
    <h1>About Section</h1>
    <a href="{{ route('about.create') }}" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birthday</th>
                <th>Website</th>
                <th>Phone</th>
                <th>City</th>
                <th>Age</th>
                <th>Degree</th>
                <th>Email</th>
                <th>Freelance</th>
                <th>Description</th>
                <th>Image URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($abouts as $about)
                <tr>
                    <td>{{ $about->name }}</td>
                    <td>{{ $about->birthday }}</td>
                    <td>{{ $about->website }}</td>
                    <td>{{ $about->phone }}</td>
                    <td>{{ $about->city }}</td>
                    <td>{{ $about->age }}</td>
                    <td>{{ $about->degree }}</td>
                    <td>{{ $about->email }}</td>
                    <td>{{ $about->freelance ? 'Yes' : 'No' }}</td>
                    <td>{{ $about->description }}</td>
                    <td>{{ $about->image_url }}</td>
                    <td>
                        <a href="{{ route('about.edit', $about->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('about.destroy', $about->id) }}" method="POST" style="display:inline;">
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