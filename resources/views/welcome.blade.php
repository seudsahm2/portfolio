<x-app-layout>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Meta and Title -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ optional($about)->name ?? 'No Name Provided' }}Portfolio</title>
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
        <img src="{{ $hero ? asset('storage/' . $hero->image) : asset('assets/img/default-hero.jpg') }}" 
            alt="Hero Image" data-aos="fade-in" class="hero_img">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <h2>{{ optional($hero)->title ?? 'Welcome to My Portfolio' }}</h2>
            <p>
                @if($professions->isNotEmpty())
                    <span class="typed" data-typed-items="
                        @foreach($professions as $profession)
                            I'm {{ $profession->name }}@if(!$loop->last)|@endif
                        @endforeach
                    "></span>
                @else
                    <span class="typed" data-typed-items="I'm a Designer|I'm a Developer|I'm a Freelancer|I'm a Photographer"></span>
                @endif
            </p>
        </div>
      </section>
      <!-- =================== End Hero Section =================== -->

      <!-- =================== About Section =================== -->
      <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up">
          <h2>About</h2>
          <p>
              {{ optional($about)->objective ?? '' }}
          </p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4 align-items-center">
            <!-- Image Column -->
            <div class="col-lg-4 col-md-6 text-center">
              <div class="about-image-wrapper">
                <img src="{{ $about ? asset('storage/' . $about->image_url) : asset('assets/img/default-about.jpg') }}" 
                     class="img-fluid about-image" alt="{{ optional($about)->name ?? 'About Section' }}">
              </div>
            </div>

            <!-- Content Column -->
            <div class="col-lg-8 content">
              <h2>{{ optional($about)->name ?? 'No Name Provided' }}</h2>
              <p class="fst-italic py-3"></p>
              <div class="row">
                <div class="col-lg-6">
                  <ul>
                    <!-- Each property is safely accessed using optional() with a fallback value -->
                    <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>{{ optional($about)->birthday ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span>{{ optional($about)->website ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span>{{ optional($about)->phone ?? 'N/A' }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Location:</strong> <span>{{ optional($about)->city ?? 'N/A' }}</span></li>
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
          <!-- Display about description or a fallback message -->
          <p class="py-3">{{ optional($about)->description ?? '' }}</p>
            </div>
          </div>
        </div>
      </section>
      <!-- =================== End About Section =================== -->


      <!-- =================== Resume Section =================== -->
      <section id="resume" class="resume section">
        <div class="container section-title" data-aos="fade-up">
          <h2>Resume</h2>
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

            <!-- =================== Skills Section =================== -->
            <section id="skills" class="skills section light-background">
        <div class="container section-title" data-aos="fade-up">
          <h2>Skills</h2>
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

      <!-- =================== Education Section =================== -->
      <!-- =================== Education Section =================== -->
      <section id="education" class="education section">
        <div class="container section-title" data-aos="fade-up">
          <h2>Education</h2>
        </div>

        <div class="container">
          <div class="row gy-4">
            @foreach($educations as $education)
            <div class="col-12" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->iteration }}">
              <div class="education-item position-relative">
                <div class="timeline-point"></div>
                <div class="education-content">
                  <div class="education-header">
                    <h4 class="education-title">{{ $education->title }}</h4>
                    <div class="education-dates">
                      <i class="bi bi-calendar-event"></i>
                      @if($education->start_date)
                        {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - 
                      @endif
                      {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('M Y')  : 'Present' }}
                    </div>
                  </div>
                  <h5 class="education-subtitle">{{ $education->subtitle }}</h5>
                  <div class="education-meta">
                    @if($education->location)
                    <span class="education-location">
                      <i class="bi bi-geo-alt"></i>{{ $education->location }}
                    </span>
                    @endif
                    @if($education->grade)
                    <span class="education-grade">
                      <i class="bi bi-award"></i>{{ $education->grade }}
                    </span>
                    @endif
                  </div>
                  @if($education->description)
                  <div class="education-description">
                    {{ $education->description }}
                  </div>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </section>
      <!-- =================== End Education Section =================== -->

      <!-- Languages Section -->
      <section id="languages" class="languages section">
          <div class="container section-title" data-aos="fade-up">
              <h2>Languages</h2>
          </div>

          <div class="container" data-aos="fade-up" data-aos-delay="100">
              <ul>
                  @foreach ($languages as $language)
                      <li><strong>{{ $language->name }}:</strong> {{ $language->proficiency }}</li>
                  @endforeach
              </ul>
          </div>
      </section>

      <!-- Experience Section -->
      <section id="experience" class="experience section">
          <div class="container section-title" data-aos="fade-up">
              <h2>Experience</h2>
          </div>

          <div class="container" data-aos="fade-up" data-aos-delay="100">
              @foreach ($experiences as $experience)
                  <div class="experience-item mb-4">
                      <h4>{{ $experience->organization }}</h4>
                      <p><em>{{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}</em></p>
                      <p>{{ $experience->description }}</p>
                  </div>
              @endforeach

              <div class="text-center mt-4">
                  <a href="{{ route('experiences.all') }}" class="btn btn-primary">See More</a>
              </div>
          </div>
      </section>

            <!-- Certificates Section -->
      <section id="certificates" class="certificates section">
          <div class="container section-title" data-aos="fade-up">
              <h2>Certificates</h2>
          </div>

          <div class="container" data-aos="fade-up" data-aos-delay="100">
              @foreach ($certificates as $certificate)
                  <div class="certificate-item mb-4">
                      <h3>{{ $certificate->title }}</h3>
                      <h4>{{ $certificate->organization }}</h4>
                      <p><em>{{ $certificate->awarded_date ?? 'N/A' }}</em></p>
                      <p>{{ $certificate->description }}</p>
                  </div>
              @endforeach
          </div>
      </section>

      <!-- Trainings Section -->
      <section id="trainings" class="trainings section">
          <div class="container section-title" data-aos="fade-up">
              <h2>Trainings</h2>
          </div>

          <div class="container" data-aos="fade-up" data-aos-delay="100">
              @foreach ($trainings as $training)
                  <div class="training-item mb-4">
                      <h3>{{ $training->title }}</h3>
                      <h4>{{ $training->organization }}</h4>
                      <p><em>{{ $training->start_date ?? 'N/A' }} - {{ $training->end_date ?? 'Present' }}</em></p>
                      <p>{{ $training->description }}</p>
                  </div>
              @endforeach
              <div class="text-center mt-4">
                  <a href="{{ route('trainings.all') }}" class="btn btn-primary">See More</a>
              </div>
          </div>
      </section>

      <!-- Awards Section -->
      <section id="awards" class="awards section">
          <div class="container section-title" data-aos="fade-up">
              <h2>Awards</h2>
          </div>

          <div class="container" data-aos="fade-up" data-aos-delay="100">
              @foreach ($awards as $award)
                  <div class="award-item mb-4">
                      <h3>{{ $award->title }}</h3>
                      <h4>{{ $award->organization }}</h4>
                      <p><em>{{ $award->date_given ?? 'N/A' }}</em></p>
                      <p>{{ $award->description }}</p>
                  </div>
              @endforeach
          </div>
      </section>

      <!-- Testimonials Section -->
      <section id="testimonials" class="testimonials section">
          <div class="container section-title" data-aos="fade-up">
              <h2>References</h2>
          </div>

          <div class="container" data-aos="fade-up" data-aos-delay="100">
              <div class="testimonial-carousel">
                  @foreach ($testimonials as $testimonial)
                      <div class="testimonial-card">
                          <img src="{{ asset('storage/' . $testimonial->image_url) }}" alt="{{ $testimonial->name }}" class="testimonial-image">
                          <div class="testimonial-details">
                              <h3>{{ $testimonial->name }}</h3>
                              <h4>{{ $testimonial->role }}</h4>
                              <p>{{ $testimonial->organization }}</p>
                              <p><a href="mailto:{{ $testimonial->email }}">{{ $testimonial->email }}</a></p>
                              <p>{{ $testimonial->phone }}</p>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>

      <!-- =================== Contact Section =================== -->
      <section id="contact" class="contact section">
          <div class="container section-title" data-aos="fade-up">
              <h2>Contact</h2>
          </div>

          <div class="container" data-aos="fade-up" data-aos-delay="100">
              <!-- Status Messages -->
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              @if(session('error')) <!-- Added to catch controller error message -->
              <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @elseif($errors->any()) <!-- Validation errors -->
              <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                  <ul class="mb-0">
                      @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <div class="row justify-content-center">
                  <div class="col-12 col-lg-8">
                      <form action="{{ route('contact.save') }}" method="post" class="php-email-form">
                          @csrf
                          <div class="row gy-3">
                              <div class="col-md-6">
                                  <label for="name" class="form-label">Your Name</label>
                                  <input type="text" name="name" id="name" class="form-control" 
                                        value="{{ old('name') }}" required>
                              </div>

                              <div class="col-md-6">
                                  <label for="email" class="form-label">Your Email</label>
                                  <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email') }}" required>
                              </div>

                              <div class="col-12">
                                  <label for="subject" class="form-label">Subject (optional)</label>
                                  <input type="text" name="subject" id="subject" class="form-control"
                                        value="{{ old('subject') }}">
                              </div>

                              <div class="col-12">
                                  <label for="message" class="form-label">Message</label>
                                  <textarea name="message" id="message" class="form-control" 
                                            rows="5" required>{{ old('message') }}</textarea>
                              </div>

                              <div class="col-12 text-center mt-4">
                                  <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto">
                                      Send Message
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </section>
      <!-- =================== End Contact Section =================== -->

      <!-- =================== Footer =================== -->
      @include('partials.footer')
      <!-- =================== End Footer =================== -->

      <!-- Scroll Top -->
      <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Preloader -->
      <div id="preloader"></div>

      <!-- Vendor JS Files -->
      <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
