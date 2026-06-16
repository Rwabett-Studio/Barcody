<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoEventsSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::orderBy('id')->pluck('id')->values();

        if (! $user || $categories->isEmpty()) {
            $this->command?->warn('Demo events skipped: at least one user and one category are required.');
            return;
        }

        $events = [
            ['name' => 'Garden Wedding Ceremony', 'date' => '2026-06-15', 'time' => '18:30', 'location' => 'Nile Garden Hall', 'status' => 'published', 'confirmed' => 92, 'canceled' => 6, 'failed' => 1, 'scanned' => 41],
            ['name' => 'Rooftop Engagement Night', 'date' => '2026-07-03', 'time' => '20:00', 'location' => 'Cairo Skyline Terrace', 'status' => 'published', 'confirmed' => 74, 'canceled' => 4, 'failed' => 2, 'scanned' => 29],
            ['name' => 'Family Reception Dinner', 'date' => '2026-07-22', 'time' => '19:00', 'location' => 'Royal Orchid Ballroom', 'status' => 'draft', 'confirmed' => 55, 'canceled' => 3, 'failed' => 0, 'scanned' => 12],
            ['name' => 'Beachside Wedding Party', 'date' => '2026-08-09', 'time' => '17:45', 'location' => 'Alexandria Coast Venue', 'status' => 'published', 'confirmed' => 128, 'canceled' => 9, 'failed' => 3, 'scanned' => 67],
            ['name' => 'Luxury Bridal Shower', 'date' => '2026-08-28', 'time' => '16:00', 'location' => 'Pearl Lounge', 'status' => 'draft', 'confirmed' => 36, 'canceled' => 2, 'failed' => 1, 'scanned' => 8],
            ['name' => 'Classic Wedding Banquet', 'date' => '2026-09-12', 'time' => '19:30', 'location' => 'Grand Lotus Hall', 'status' => 'published', 'confirmed' => 143, 'canceled' => 11, 'failed' => 4, 'scanned' => 82],
            ['name' => 'Private Engagement Lunch', 'date' => '2026-09-26', 'time' => '14:00', 'location' => 'Villa Jasmine', 'status' => 'published', 'confirmed' => 48, 'canceled' => 1, 'failed' => 0, 'scanned' => 21],
            ['name' => 'Modern Wedding Celebration', 'date' => '2026-10-10', 'time' => '21:00', 'location' => 'Urban Events House', 'status' => 'draft', 'confirmed' => 87, 'canceled' => 5, 'failed' => 2, 'scanned' => 33],
            ['name' => 'Golden Anniversary Event', 'date' => '2026-10-24', 'time' => '18:00', 'location' => 'Heritage Palace', 'status' => 'published', 'confirmed' => 65, 'canceled' => 4, 'failed' => 1, 'scanned' => 39],
            ['name' => 'Outdoor Henna Evening', 'date' => '2026-11-06', 'time' => '20:30', 'location' => 'Palm Courtyard', 'status' => 'published', 'confirmed' => 104, 'canceled' => 7, 'failed' => 2, 'scanned' => 58],
        ];

        foreach ($events as $index => $event) {
            Event::updateOrCreate(
                ['name' => $event['name']],
                array_merge($event, [
                    'description' => $event['name'].' invitation and guest management event.',
                    'thumbnail_image' => '',
                    'maps' => 'https://maps.google.com/?q='.urlencode($event['location']),
                    'category_id' => $categories[$index % $categories->count()],
                    'user_id' => $user->id,
                ])
            );
        }
    }
}
