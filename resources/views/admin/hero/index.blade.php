@extends('layouts.admin')

@section('content')
    <h1>Hero Section</h1>
    @if($hero->isNotEmpty())
        <a href="{{ route('hero.edit', $hero->first()->id) }}" class="btn btn-primary">Edit First Hero</a>
    @else
        <p>No heroes available. <a href="{{ route('hero.create') }}" class="btn btn-primary">Add Hero</a></p>
    @endif
    <table class="table">
        <thead>
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
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('hero.edit', $heroItem->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('hero.destroy', $heroItem->id) }}" method="POST" style="display:inline;">
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