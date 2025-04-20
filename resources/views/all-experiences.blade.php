<x-app-layout>
    <head>
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    </head>
    <div class="experience section">
        <div class="container section-title" data-aos="fade-up">
            <h2>All Experiences</h2>
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
                <a href="{{ route('welcome') }}" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');

            // Check for saved theme in localStorage
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                themeIcon.classList.replace('bi-moon', 'bi-sun');
            }

            // Toggle theme on button click
            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                const isDarkMode = document.body.classList.contains('dark-mode');

                // Update the icon
                if (isDarkMode) {
                    themeIcon.classList.replace('bi-moon', 'bi-sun');
                    localStorage.setItem('theme', 'dark'); // Save preference
                } else {
                    themeIcon.classList.replace('bi-sun', 'bi-moon');
                    localStorage.setItem('theme', 'light'); // Save preference
                }
            });
        });
    </script>
</x-app-layout>