<x-app-layout>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Meta and Title -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - iPortfolio Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  </head>

  <body class="index-page">
    @include('partials.header')

    <main class="main">
      <!-- =================== Hero Section =================== -->
      <section id="hero" class="hero section dark-background">
        <!-- If $hero exists use its image; otherwise fallback to a default image -->
        <img src="{{ $hero ? asset('storage/' . $hero->image) : asset('assets/img/default-hero.jpg') }}" 
             alt="Hero Image" data-aos="fade-in" class="">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <!-- Use hero title if available, else a default welcome text -->
          <h2>{{ optional($hero)->title ?? 'Welcome to My Portfolio' }}</h2>
          <!-- If $hero->typed_items exists, use it; else fallback to default typed values -->
          <p>I'm <span class="typed" data-typed-items="{{ optional($hero)->typed_items ?? 'Designer, Developer, Freelancer, Photographer' }}"></span><span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span></p>
        </div>
      </section>
      <!-- =================== End Hero Section =================== -->

      <!-- =================== About Section =================== -->
      <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up">
          <h2>About</h2>
          <!-- Display about description or a fallback message -->
          <p>{{ optional($about)->description ?? 'No description available' }}</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4 justify-content-center">
            <div class="col-lg-4">
              <!-- If about image exists, show it; else use a default image -->
              <img src="{{ $about ? asset($about->image_url) : asset('assets/img/default-about.jpg') }}" 
                   class="img-fluid" alt="{{ optional($about)->name ?? 'About Section' }}">
            </div>
            <div class="col-lg-8 content">
              <!-- Display about name or default text -->
              <h2>{{ optional($about)->name ?? 'No Name Provided' }}</h2>
              <p class="fst-italic py-3"></p>
              <div class="row">
                <div class="col-lg-6">
                  <ul>
                    <!-- Each property is safely accessed using optional() with a fallback value -->
                    <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>{{ optional($about)->birthday ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span>{{ optional($about)->website ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span>{{ optional($about)->phone ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>{{ optional($about)->city ?? 'N/A' }}</span></li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul>
                    <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>{{ optional($about)->age ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span>{{ optional($about)->degree ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>{{ optional($about)->email ?? 'N/A' }}</span></li>
                    <!-- Check if freelance is set and true -->
                    <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span>{{ isset($about) && $about->freelance ? 'Available' : 'Not Available' }}</span></li>
                  </ul>
                </div>
              </div>
              <!-- Display work experience or a fallback message -->
              <p class="py-3">
                {{ optional($about)->work_experiance ?? 'No work experience provided' }}
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- =================== End About Section =================== -->

      <!-- =================== Skills Section =================== -->
      <section id="skills" class="skills section light-background">
        <div class="container section-title" data-aos="fade-up">
          <h2>Skills</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row skills-content skills-animation">
            <!-- Check if $skills exists and has items -->
            @if(isset($skills) && $skills->count())
              @foreach($skills as $skill)
                <div class="col-lg-6">
                  <div class="progress">
                    <span class="skill"><span>{{ $skill->name }}</span> <i class="val">{{ $skill->percentage }}%</i></span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar" role="progressbar" aria-valuenow="{{ $skill->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="col-12">
                <p>No skills available.</p>
              </div>
            @endif
          </div>
        </div>
      </section>
      <!-- =================== End Skills Section =================== -->

      <!-- =================== Resume Section =================== -->
      <section id="resume" class="resume section">
        <div class="container section-title" data-aos="fade-up">
          <h2>Resume</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="container">
          <div class="row">
            <!-- Check if $resumes exists and has items -->
            @if(isset($resumes) && $resumes->count())
              @foreach($resumes->groupBy('type') as $type => $items)
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                  <h3 class="resume-title">{{ ucfirst($type) }}</h3>
                  @foreach($items as $item)
                    <div class="resume-item pb-0">
                      <h4>{{ $item->title }}</h4>
                      @if($item->subtitle)
                        <p><em>{{ $item->subtitle }}</em></p>
                      @endif
                      @if($item->location)
                        <ul>
                          <li>{{ $item->location }}</li>
                          @if($item->contact)
                            <li>{{ $item->contact }}</li>
                          @endif
                        </ul>
                      @endif
                      <p>{{ $item->description }}</p>
                      @if($item->start_date || $item->end_date)
                        <p><em>{{ $item->start_date }} - {{ $item->end_date }}</em></p>
                      @endif
                    </div>
                  @endforeach
                </div>
              @endforeach
            @else
              <div class="col-12">
                <p>No resume items available.</p>
              </div>
            @endif
          </div>
        </div>
      </section>
      <!-- =================== End Resume Section =================== -->

      <!-- =================== Testimonials Section =================== -->
      <section id="testimonials" class="testimonials section light-background">
        <div class="container section-title" data-aos="fade-up">
          <h2>Testimonials</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <!-- Check if $testimonials exists and has items -->
          @if(isset($testimonials) && $testimonials->count())
            <div class="swiper init-swiper">
              <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                  <div class="swiper-slide">
                    <div class="testimonial-item">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>{{ $testimonial->quote }}</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <img src="{{ asset($testimonial->image_url) }}" class="testimonial-img" alt="{{ $testimonial->name }}">
                      <h3>{{ $testimonial->name }}</h3>
                      <h4>{{ $testimonial->role }}</h4>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="swiper-pagination"></div>
            </div>
          @else
            <p>No testimonials available.</p>
          @endif
        </div>
      </section>
      <!-- =================== End Testimonials Section =================== -->

      <!-- =================== Contact Section =================== -->
      <section id="contact" class="contact section">
        <div class="container section-title" data-aos="fade-up">
          <h2>Contact</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-5">
              <div class="info-wrap">
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h3>Address</h3>
                    <!-- Use about location or fallback message -->
                    <p>{{ optional($about)->location ?? 'No address available' }}</p>
                  </div>
                </div>

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone flex-shrink-0"></i>
                  <div>
                    <h3>Call Us</h3>
                    <p>{{ optional($about)->phone ?? 'No phone number available' }}</p>
                  </div>
                </div>

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h3>Email Us</h3>
                    <p>{{ optional($about)->email ?? 'No email available' }}</p>
                  </div>
                </div>

                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>

            <div class="col-lg-7">
              <form action="{{ route('contact.store') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
                <div class="row gy-4">
                  <div class="col-md-6">
                    <label for="name-field" class="pb-2">Your Name</label>
                    <input type="text" name="name" id="name-field" class="form-control" required="">
                  </div>

                  <div class="col-md-6">
                    <label for="email-field" class="pb-2">Your Email</label>
                    <input type="email" class="form-control" name="email" id="email-field" required="">
                  </div>

                  <div class="col-md-12">
                    <label for="subject-field" class="pb-2">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject-field" required="">
                  </div>

                  <div class="col-md-12">
                    <label for="message-field" class="pb-2">Message</label>
                    <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                  </div>

                  <div class="col-md-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                    <button type="submit">Send Message</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- =================== End Contact Section =================== -->

      <!-- =================== Footer =================== -->
      <footer id="footer" class="footer position-relative light-background">
        <div class="container">
          <div class="copyright text-center">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">iPortfolio</strong> <span>All Rights Reserved</span></p>
          </div>
          <div class="credits">
            <!-- Keep these links intact as per licensing -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
          </div>
        </div>
      </footer>
      <!-- =================== End Footer =================== -->

      <!-- Scroll Top -->
      <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Preloader -->
      <div id="preloader"></div>

      <!-- Vendor JS Files -->
      <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
      <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
      <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
      <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
      <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
      <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

      <!-- Main JS File -->
      <script src="{{ asset('assets/js/main.js') }}"></script>
    </main>
  </body>

  </html>
</x-app-layout>
