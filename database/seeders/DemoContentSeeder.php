<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Event;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        // Partners
        if (Partner::count() < 6) {
            foreach (['OJK', 'IDX', 'Bank Syariah', 'Koperasi', 'Kampus', 'Komunitas'] as $name) {
                Partner::firstOrCreate(['name' => $name]);
            }
        }

        // Events
        if (Event::count() < 5) {
            for ($i = 1; $i <= 5; $i++) {
                Event::firstOrCreate(
                    ['title' => "Webinar Ekonomi Syariah $i"],
                    ['start_at' => Carbon::now()->addDays($i * 3)]
                );
            }
        }

        // Articles
        if (Article::count() < 9) {
            for ($i = 1; $i <= 9; $i++) {
                $title = "Inisiatif Syariah untuk UMKM #$i";
                Article::updateOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'title' => $title,
                        'thumbnail' => "https://picsum.photos/seed/mes{$i}/640/360",
                        'excerpt' => "Gambaran singkat program pemberdayaan UMKM syariah edisi $i di Depok.",
                        'body' => "Konten ringkas mengenai kegiatan dan dampak program ke-$i.\nDilengkapi insight praktis bagi pelaku usaha.",
                        'status' => 'published',
                        'published_at' => Carbon::now()->subDays($i),
                        'author_id' => 1,
                    ]
                );
            }
        }
    }
}
