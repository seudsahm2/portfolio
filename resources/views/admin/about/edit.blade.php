@extends('layouts.admin')

@section('content')
    <h1>Edit About Section</h1>
    <form action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $about->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Birthday -->
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" name="birthday" id="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{ old('birthday', $about->birthday) }}" required onchange="calculateAge()">
            @error('birthday')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Age (calculated and uneditable) -->
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ \Carbon\Carbon::parse($about->birthday)->age }}" readonly>
        </div>

        <!-- Website -->
        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website', $about->website) }}">
            @error('website')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $about->phone) }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- City -->
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $about->city) }}" required>
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Degree -->
        <div class="form-group">
            <label for="degree">Degree</label>
            <input type="text" name="degree" id="degree" class="form-control @error('degree') is-invalid @enderror" value="{{ old('degree', $about->degree) }}" required>
            @error('degree')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $about->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Freelance -->
        <div class="form-group">
            <label for="freelance">Freelance</label>
            <select name="freelance" id="freelance" class="form-control @error('freelance') is-invalid @enderror" required>
                <option value="1" {{ old('freelance', $about->freelance) == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('freelance', $about->freelance) == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('freelance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $about->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Additional Info -->
        <div class="form-group">
            <label for="additional_info">Additional Info</label>
            <textarea name="additional_info" id="additional_info" class="form-control @error('additional_info') is-invalid @enderror" rows="5">{{ old('additional_info', $about->additional_info) }}</textarea>
            @error('additional_info')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image -->
        <div class="form-group">
            <label for="image_url">Image</label>
            <input type="file" name="image_url" id="image_url" class="form-control @error('image_url') is-invalid @enderror">
            @if ($about->image_url)
                <img src="{{ asset('storage/' . $about->image_url) }}" alt="Current Image" width="100">
            @endif
            @error('image_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        function calculateAge() {
            const birthday = document.getElementById('birthday').value;
            const ageField = document.getElementById('age');
            if (birthday) {
                const birthDate = new Date(birthday);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                ageField.value = age > 0 ? age : '';
            } else {
                ageField.value = '';
            }
        }
    </script>
@endsection