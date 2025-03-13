
@extends('layouts.admin')

@section('content')
    <h1>Skills</h1>
    <a href="{{ route('skill.create') }}" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Percentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skills as $skill)
                <tr>
                    <td>{{ $skill->name }}</td>
                    <td>{{ $skill->percentage }}%</td>
                    <td>
                        <a href="{{ route('skill.edit', $skill->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('skill.destroy', $skill->id) }}" method="POST" style="display:inline;">
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