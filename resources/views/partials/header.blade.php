<header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
      <img src="{{ asset('assets/img/my-profile-img.jpg') }}" alt="" class="img-fluid rounded-circle">
    </div>

    <a href="{{ url('/') }}" class="logo d-flex align-items-center justify-content-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="{{ asset('assets/img/logo.png') }}" alt=""> -->
      <h1 class="sitename">Alex Smith</h1>
    </a>

    <div class="social-links text-center">
      <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
    </div>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
        <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
        <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
        <li><a href="#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
      </ul>
    </nav>
</header>