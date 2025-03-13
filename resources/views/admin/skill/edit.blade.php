
@extends('layouts.admin')

@section('content')
    <h1>Edit Skill</h1>
    <form action="{{ route('skill.update', $skill->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $skill->name }}" required>
        </div>
        <div class="form-group">
            <label for="percentage">Percentage</label>
            <input type="number" name="percentage" id="percentage" class="form-control" value="{{ $skill->percentage }}" min="0" max="100" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection