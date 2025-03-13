<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('about.index') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('resume.index') }}">Resume</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('skill.index') }}">Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('service.index') }}">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('testimonial.index') }}">Testimonials</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('portfolio.index') }}">Portfolio</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>