
@extends('layouts.admin')

@section('content')
    <h1>Edit Certificate</h1>
    <form action="{{ route('certificate.update', $certificate->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Certificate Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $certificate->title }}" required>
        </div>
        <div class="form-group">
            <label for="organization">Issuing Organization</label>
            <input type="text" name="organization" id="organization" class="form-control" value="{{ $certificate->organization }}" required>
        </div>
        <div class="form-group">
            <label for="awarded_date">Awarded Date</label>
            <input type="date" name="awarded_date" id="awarded_date" class="form-control" value="{{ $certificate->awarded_date }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $certificate->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Certificate</button>
    </form>
@endsection