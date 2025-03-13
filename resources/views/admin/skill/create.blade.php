
@extends('layouts.admin')

@section('content')
    <h1>Create Skill</h1>
    <form action="{{ route('skill.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="percentage">Percentage</label>
            <input type="number" name="percentage" id="percentage" class="form-control" min="0" max="100" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection