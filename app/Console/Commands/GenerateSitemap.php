<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for all public routes';

    public function handle()
    {
        $this->info('🚀 Generating sitemap...');

        $sitemap = Sitemap::create();

        $urls = [
            '/',              // Home
            '/about',         // About
            '/contact',       // Contact
            '/resume',        // Resume
            '/testimonials',  // Testimonials
            '/skills',        // Skills
            '/education',     // Education
            '/experience',    // Experience
            '/certificates',  // Certificates
            '/trainings',     // Trainings
            '/awards',        // Awards
            '/languages',     // Languages
            '/professions',   // Professions
        ];

        foreach ($urls as $url) {
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        }

        // Save sitemap to public directory
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated successfully: public/sitemap.xml');
    }
}
