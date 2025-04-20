<header id="header" class="header dark-background d-flex flex-column">
    <!-- Hamburger Menu Icon -->
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <!-- Profile Image -->
    <div class="profile-img">
        @php
            $hero = \App\Models\Hero::first();
        @endphp
        <img src="{{ $hero && $hero->portfolio_image ? asset('storage/' . $hero->portfolio_image) : asset('assets/img/default-profile.png') }}" 
            alt="Portfolio Image" class="img-fluid rounded-circle">
    </div>

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo d-flex align-items-center justify-content-center">
        <h4 class="sitename">{{ optional($about)->name ?? 'No Name Provided' }}</h4>
    </a>

    <!-- Dark/Light Mode Toggle Button -->
    <div class="theme-toggle-container">
        <button id="theme-toggle">
            <i id="theme-icon" class="bi bi-moon"></i>
        </button>
    </div>

    <!-- Social Links -->
    <div class="social-links text-center">
        <a href="https://web.facebook.com/ahmed.jafer.54" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/ahmed_jaferrr?igsh=c2pleDYzZ2dheG5n" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/in/ahmed-jafer-dawud-7726b8199" class="linkedin"><i class="bi bi-linkedin"></i></a>
    </div>

    <!-- Navigation Menu -->
    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
            <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
            <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
            <li><a href="#skills"><i class="bi bi-star navicon"></i> Skills</a></li>
            <li><a href="#education"><i class="bi bi-mortarboard navicon"></i> Education</a></li>
            <li><a href="#languages" class="nav-link"><i class="bi bi-translate navicon"></i> Languages</a></li>
            <li><a href="#experience" class="nav-link"><i class="bi bi-briefcase navicon"></i> Experience</a></li>
            <li><a href="#certificates" class="nav-link"><i class="bi bi-award navicon"></i> Certificates</a></li>
            <li><a href="#trainings" class="nav-link"><i class="bi bi-journal navicon"></i> Trainings</a></li>
            <li><a href="#awards" class="nav-link"><i class="bi bi-trophy navicon"></i> Awards</a></li>
            <li><a href="#testimonials"><i class="bi bi-chat-quote navicon"></i> Testimonials</a></li>
            <li><a href="#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
        </ul>
    </nav>
</header>