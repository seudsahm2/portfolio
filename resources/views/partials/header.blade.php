<header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
        <!-- Display the user's profile image if it exists, otherwise use a default image -->
        @php
          $hero = \App\Models\Hero::first(); // or use id or slug if needed
        @endphp

        <img src="{{ $hero && $hero->portfolio_image ? asset('storage/' . $hero->portfolio_image) : asset('assets/img/default-profile.png') }}" 
            alt="Portfolio Image" class="img-fluid rounded-circle">

    </div>

    <a href="{{ url('/') }}" class="logo d-flex align-items-center justify-content-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="{{ asset('assets/img/logo.png') }}" alt=""> -->
      <h4 class="sitename">{{ optional($about)->name ?? 'No Name Provided' }}</h4>
    </a>

    <div class="social-links text-center">
      <a href="https://web.facebook.com/ahmed.jafer.54" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/ahmed_jaferrr?igsh=c2pleDYzZ2dheG5n" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="https://www.linkedin.com/in/ahmed-jafer-dawud-7726b8199" class="linkedin"><i class="bi bi-linkedin"></i></a>
    </div>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
        <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
        <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
        <li class="nav-item">
            <a class="nav-link" href="#skills"><i class="bi bi-star navicon"></i> Skills</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#education">
                <i class="bi bi-mortarboard navicon"></i> Education
            </a>
        </li>
        <li><a href="#testimonials"><i class="bi bi-chat-quote navicon"></i> Testimonials</a></li>
        <li><a href="#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
      </ul>
    </nav>
</header>