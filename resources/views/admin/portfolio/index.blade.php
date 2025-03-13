@extends('layouts.admin')

@section('content')
    <h1>Portfolio Items</h1>
    <a href="{{ route('portfolio.create') }}" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image URL</th>
                <th>Category</th>
                <th>Details URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portfolioItems as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->image_url }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->details_url }}</td>
                    <td>
                        <a href="{{ route('portfolio.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('portfolio.destroy', $item->id) }}" method="POST" style="display:inline;">
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