<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body style="padding-top: 56px;"> <!-- Padding to account for fixed-top navbar -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('hero.index') }}"><i class="bi bi-gear"></i> Hero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about.index') }}"><i class="bi bi-person"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}"><i class="bi bi-envelope"></i> Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('resume.index') }}"><i class="bi bi-file-earmark-text"></i> Resume</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skill.index') }}"><i class="bi bi-star"></i> Skills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('testimonial.index') }}"><i class="bi bi-chat-quote"></i> Testimonials</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content Area -->
    <div class="container">
        @yield('content')
    </div>

    <!-- jQuery (required for Bootstrap 4 components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS (includes Popper.js) -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>