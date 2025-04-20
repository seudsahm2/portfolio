<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel</title>
  <!-- Bootstrap CSS -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>
<body style="padding-top: 56px;"> <!-- Padding to account for fixed-top navbar -->

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="{{ route('hero.index') }}">Admin Panel</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarNav">

      <!-- Scrollable Nav (Horizontal on large, Vertical on small) -->
      <div class="d-flex flex-column flex-lg-nowrap overflow-auto w-100">
        <ul class="navbar-nav flex-column flex-lg-row">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('hero.index') }}"><i class="bi bi-display"></i> Hero</a>
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
          <li class="nav-item">
            <a class="nav-link" href="{{ route('education.index') }}"><i class="bi bi-mortarboard"></i> Education</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('professions.index') }}"><i class="bi bi-briefcase"></i> Professions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('experience.index') }}"><i class="bi bi-briefcase"></i> Experience</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('language.index') }}"><i class="bi bi-translate"></i> Languages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('certificate.index') }}"><i class="bi bi-award"></i> Certificates</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('training.index') }}"><i class="bi bi-journal"></i> Trainings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('award.index') }}"><i class="bi bi-trophy"></i> Awards</a>
</li>
        </ul>
      </div>

      <!-- Logout (Always visible on large, collapses below) -->
      <ul class="navbar-nav ms-lg-2">
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-light" style="background: none; border: none; padding: 0;">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        </li>
      </ul>

    </div>
  </nav>

  <!-- Content Area -->
  <div class="container">
    @yield('content')
  </div>

  <!-- Bootstrap JS Bundle (includes Popper) -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
