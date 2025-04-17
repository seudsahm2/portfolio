@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add Profession</h1>
        <form action="{{ route('professions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Profession Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Profession</button>
        </form>
    </div>
@endsection