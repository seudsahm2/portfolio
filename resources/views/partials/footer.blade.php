<!-- =================== Footer =================== -->
<footer id="footer" class="footer position-relative light-background py-4">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center justify-content-center text-center">
            <!-- Logo/Title and Social Links -->
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <div class="social-links text-center">
                    <a href="https://web.facebook.com/ahmed.jafer.54" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/ahmed_jaferrr?igsh=c2pleDYzZ2dheG5n" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/ahmed-jafer-dawud-7726b8199" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- Dynamic Contact Info -->
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <ul class="list-unstyled small">
                    <li><i class="bi bi-geo-alt me-2"></i>{{ optional($about)->city ?? 'No city available' }}</li>
                    <li><i class="bi bi-envelope me-2"></i>{{ optional($about)->email ?? 'No email available' }}</li>
                    <li><i class="bi bi-phone me-2"></i>{{ optional($about)->phone ?? 'No phone available' }}</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- =================== End Footer =================== -->