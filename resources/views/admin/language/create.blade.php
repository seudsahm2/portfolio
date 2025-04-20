@extends('layouts.admin')

@section('content')
    <h1>Add Language</h1>
    <form action="{{ route('language.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Language Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="proficiency">Proficiency Level</label>
            <select name="proficiency" id="proficiency" class="form-control" required>
                <option value="Native">Native</option>
                <option value="Professional Proficiency">Professional Proficiency</option>
                <option value="Limited Proficiency">Limited Proficiency</option>
                <option value="Basic">Basic</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Language</button>
    </form>
@endsection