@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Hero Section</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($hero->isNotEmpty())
            <a href="{{ route('hero.edit', $hero->first()->id) }}" class="btn btn-primary mb-3">Edit First Hero</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Skill</th>
                            <th>Image URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hero as $heroItem)
                            <tr>
                                <td>{{ $about ? $about->name : 'N/A' }}</td>
                                <td>{{ $skill ? $skill->name : 'N/A' }}</td>
                                <td>
                                    @if($heroItem->image)
                                        <img src="{{ asset('storage/' . $heroItem->image) }}" alt="Image" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('hero.edit', $heroItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('hero.destroy', $heroItem->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this hero?');">
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
            <p>No heroes available.</p>
            <a href="{{ route('hero.create') }}" class="btn btn-primary">Add Hero</a>
        @endif
    </div>
@endsection