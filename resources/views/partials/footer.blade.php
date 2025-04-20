
<!-- In your footer partial (partials/footer.blade.php) -->
<footer id="footer" class="footer">
  <div class="container">
    <div class="footer-content">
      <div class="footer-section about">
        <h3 class="footer-title">{{ optional($about)->name ?? 'Portfolio' }}</h3>
        <p class="footer-description">{{ optional($about)->brief_description ?? 'Professional Portfolio' }}</p>
        <div class="footer-contact">
          @if($about)
            <p><i class="bi bi-geo-alt"></i> {{ $about->city ?? 'City, Country' }}</p>
            <p><i class="bi bi-envelope"></i> {{ $about->email ?? 'contact@example.com' }}</p>
            <p><i class="bi bi-phone"></i> {{ $about->phone ?? '+1 234 567 890' }}</p>
          @endif
        </div>
      </div>

      <div class="footer-section links">
        <h4 class="footer-subtitle">Quick Links</h4>
        <ul>
          <li><a href="#hero"><i class="bi bi-chevron-right"></i> Home</a></li>
          <li><a href="#about"><i class="bi bi-chevron-right"></i> About</a></li>
          <li><a href="#resume"><i class="bi bi-chevron-right"></i> Resume</a></li>
          <li><a href="#contact"><i class="bi bi-chevron-right"></i> Contact</a></li>
        </ul>
      </div>

      <div class="footer-section social">
        <h4 class="footer-subtitle">Connect With Me</h4>
        <div class="social-links">
          <a href="https://web.facebook.com/ahmed.jafer.54" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/ahmed_jaferrr?igsh=c2pleDYzZ2dheG5n" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://www.linkedin.com/in/ahmed-jafer-dawud-7726b8199" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="copyright">
      &copy; Copyright <strong>{{ optional($about)->name ?? 'Portfolio' }}</strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed with <i class="bi bi-heart-fill text-danger"></i> by {{ optional($about)->name ?? 'You' }}
    </div>
  </div>
</footer>
<!-- =================== End Footer =================== -->