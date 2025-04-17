@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Profession</h1>
        <form action="{{ route('professions.update', $profession->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Profession Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $profession->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Profession</button>
        </form>
    </div>
@endsection