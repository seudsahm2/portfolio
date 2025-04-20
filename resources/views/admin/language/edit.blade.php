@extends('layouts.admin')

@section('content')
    <h1>Edit Language</h1>
    <form action="{{ route('language.update', $language->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Language Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $language->name }}" required>
        </div>
        <div class="form-group">
            <label for="proficiency">Proficiency Level</label>
            <select name="proficiency" id="proficiency" class="form-control" required>
                <option value="Native" {{ $language->proficiency == 'Native' ? 'selected' : '' }}>Native</option>
                <option value="Professional Proficiency" {{ $language->proficiency == 'Professional Proficiency' ? 'selected' : '' }}>Professional Proficiency</option>
                <option value="Limited Proficiency" {{ $language->proficiency == 'Limited Proficiency' ? 'selected' : '' }}>Limited Proficiency</option>
                <option value="Basic" {{ $language->proficiency == 'Basic' ? 'selected' : '' }}>Basic</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Language</button>
    </form>
@endsection