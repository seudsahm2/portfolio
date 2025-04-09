<!-- =================== Footer =================== -->
<footer id="footer" class="footer position-relative light-background py-4">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center justify-content-center text-center">
            <!-- Logo/Title and Social Links -->
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <h3 class="sitename mb-3">iPortfolio</h3>
                <div class="social-links">
                    <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
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

            <!-- Copyright and Credits -->
            <div class="col-12 col-md-4">
                <div class="copyright mb-2">
                    <p class="small mb-0">© <span>Copyright</span> <strong class="px-1 sitename">iPortfolio</strong> <span>All Rights Reserved</span></p>
                </div>
                <div class="credits small">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- =================== End Footer =================== -->