<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $adminId = $this->seedOne('users', ['email' => 'admin@barcody.test'], [
            'name' => 'Demo Admin',
            'email' => 'admin@barcody.test',
            'email_verified_at' => $now,
            'password' => Hash::make('Demo@12345'),
            'phone' => '+201000000001',
            'birthDay' => '1990-01-15',
            'gender' => 'male',
            'role' => 'admin',
            'create_role' => 1,
            'edit_role' => 1,
            'delete_role' => 1,
            'phone_verified_at' => $now,
            'image' => 'users/demo-admin.png',
            'remember_token' => Str::random(10),
        ]);

        $coordinatorId = $this->seedOne('users', ['email' => 'coordinator@barcody.test'], [
            'name' => 'Demo Coordinator',
            'email' => 'coordinator@barcody.test',
            'email_verified_at' => $now,
            'password' => Hash::make('Demo@12345'),
            'phone' => '+201000000002',
            'birthDay' => '1993-05-20',
            'gender' => 'female',
            'role' => 'coordinator',
            'create_role' => 1,
            'edit_role' => 1,
            'delete_role' => 0,
            'phone_verified_at' => $now,
            'image' => 'users/demo-coordinator.png',
            'remember_token' => Str::random(10),
        ]);

        $guestId = $this->seedOne('users', ['email' => 'guest@barcody.test'], [
            'name' => 'Demo Guest',
            'email' => 'guest@barcody.test',
            'email_verified_at' => $now,
            'password' => Hash::make('Demo@12345'),
            'phone' => '+201000000003',
            'birthDay' => '1996-08-10',
            'gender' => 'male',
            'role' => 'user',
            'create_role' => 0,
            'edit_role' => 0,
            'delete_role' => 0,
            'phone_verified_at' => $now,
            'image' => 'users/demo-guest.png',
            'remember_token' => Str::random(10),
        ]);

        $weddingCategoryId = $this->seedOne('categories', ['name' => 'Wedding'], [
            'name' => 'Wedding',
            'icon' => 'categories/wedding.svg',
        ]);

        $corporateCategoryId = $this->seedOne('categories', ['name' => 'Corporate'], [
            'name' => 'Corporate',
            'icon' => 'categories/corporate.svg',
        ]);

        $conferenceCategoryId = $this->seedOne('categories', ['name' => 'Conference'], [
            'name' => 'Conference',
            'icon' => 'categories/conference.svg',
        ]);

        $weddingEventId = $this->seedOne('events', ['name' => 'Nour and Omar Wedding'], [
            'name' => 'Nour and Omar Wedding',
            'description' => 'A demo wedding invitation with QR check-in and guest responses.',
            'thumbnail_image' => 'events/demo-wedding.jpg',
            'date' => $now->copy()->addMonth()->toDateString(),
            'time' => '19:30:00',
            'location' => 'Cairo Festival City, Cairo',
            'maps' => 'https://maps.google.com/?q=Cairo+Festival+City',
            'qr_code' => 'demo-events/nour-omar-wedding.png',
            'status' => 'published',
            'user_id' => $adminId,
            'category_id' => $weddingCategoryId,
            'confirmed' => 42,
            'canceled' => 4,
            'failed' => 1,
            'scanned' => 18,
        ]);

        $corporateEventId = $this->seedOne('events', ['name' => 'Barcody Product Launch'], [
            'name' => 'Barcody Product Launch',
            'description' => 'A demo corporate launch event for testing invitations and attendance.',
            'thumbnail_image' => 'events/demo-launch.jpg',
            'date' => $now->copy()->addWeeks(3)->toDateString(),
            'time' => '18:00:00',
            'location' => 'The Greek Campus, Cairo',
            'maps' => 'https://maps.google.com/?q=The+Greek+Campus+Cairo',
            'qr_code' => 'demo-events/barcody-product-launch.png',
            'status' => 'published',
            'user_id' => $coordinatorId,
            'category_id' => $corporateCategoryId,
            'confirmed' => 65,
            'canceled' => 7,
            'failed' => 2,
            'scanned' => 31,
        ]);

        $this->seedOne('event_categories', [
            'event_id' => $weddingEventId,
            'category_id' => $weddingCategoryId,
        ], [
            'event_id' => $weddingEventId,
            'category_id' => $weddingCategoryId,
        ]);

        $this->seedOne('event_categories', [
            'event_id' => $corporateEventId,
            'category_id' => $corporateCategoryId,
        ], [
            'event_id' => $corporateEventId,
            'category_id' => $corporateCategoryId,
        ]);

        $this->seedOne('event_categories', [
            'event_id' => $corporateEventId,
            'category_id' => $conferenceCategoryId,
        ], [
            'event_id' => $corporateEventId,
            'category_id' => $conferenceCategoryId,
        ]);

        $this->seedOne('attendees', ['event_id' => $weddingEventId, 'user_id' => $coordinatorId], [
            'event_id' => $weddingEventId,
            'user_id' => $coordinatorId,
            'status' => 'attending',
        ]);

        $this->seedOne('attendees', ['event_id' => $weddingEventId, 'user_id' => $guestId], [
            'event_id' => $weddingEventId,
            'user_id' => $guestId,
            'status' => 'pending',
        ]);

        $this->seedOne('attendees', ['event_id' => $corporateEventId, 'user_id' => $adminId], [
            'event_id' => $corporateEventId,
            'user_id' => $adminId,
            'status' => 'attending',
        ]);

        $contactOneId = $this->seedOne('contacts', ['phone' => '+201111111111'], [
            'gender' => 'female',
            'name' => 'Mariam Hassan',
            'phone' => '+201111111111',
            'user_id' => (string) $adminId,
            'event_id' => $weddingEventId,
            'invited' => 1,
            'status' => 'accepted',
            'invited_at' => $now->copy()->subDays(4),
            'responded_at' => $now->copy()->subDays(2),
        ]);

        $contactTwoId = $this->seedOne('contacts', ['phone' => '+201222222222'], [
            'gender' => 'male',
            'name' => 'Youssef Ali',
            'phone' => '+201222222222',
            'user_id' => (string) $adminId,
            'event_id' => $weddingEventId,
            'invited' => 1,
            'status' => 'pending',
            'invited_at' => $now->copy()->subDay(),
        ]);

        $this->seedOne('contacts', ['phone' => '+201333333333'], [
            'gender' => 'female',
            'name' => 'Salma Adel',
            'phone' => '+201333333333',
            'user_id' => (string) $coordinatorId,
            'event_id' => $corporateEventId,
            'invited' => 1,
            'status' => 'declined',
            'invited_at' => $now->copy()->subDays(5),
            'responded_at' => $now->copy()->subDays(3),
        ]);

        $this->seedOne('notifications', ['contact_id' => $contactOneId, 'type' => 'response'], [
            'contact_id' => $contactOneId,
            'event_id' => $weddingEventId,
            'type' => 'response',
            'message' => 'Mariam Hassan accepted the wedding invitation.',
            'status' => 'read',
            'read_at' => $now->copy()->subDay(),
        ]);

        $this->seedOne('notifications', ['contact_id' => $contactTwoId, 'type' => 'invitation'], [
            'contact_id' => $contactTwoId,
            'event_id' => $weddingEventId,
            'type' => 'invitation',
            'message' => 'Invitation sent to Youssef Ali.',
            'status' => 'unread',
        ]);

        $this->seedOne('settings', ['location' => 'Cairo, Egypt'], [
            'name' => 'Barcody Demo',
            'fav_icon' => 'settings/favicon.png',
            'header_logo' => 'settings/header-logo.png',
            'footer_logo' => 'settings/footer-logo.png',
            'location' => 'Cairo, Egypt',
            'maps' => 'https://maps.google.com/?q=Cairo+Egypt',
        ]);

        $this->seedOne('social_media', ['email' => 'hello@barcody.test'], [
            'email' => 'hello@barcody.test',
            'phone' => '+201000000010',
            'whatsapp' => '+201000000010',
            'facebook' => 'https://facebook.com/barcody',
            'youtube' => 'https://youtube.com/@barcody',
            'twitter' => 'https://x.com/barcody',
        ]);

        $this->seedOne('supportsettings', ['email' => 'support@barcody.test'], [
            'name' => 'Barcody Support',
            'email' => 'support@barcody.test',
            'phone' => '+201000000011',
            'whatsapp' => '+201000000011',
            'facebook' => 'https://facebook.com/barcody',
            'youtube' => 'https://youtube.com/@barcody',
            'twitter' => 'https://x.com/barcody',
            'instagram' => 'https://instagram.com/barcody',
            'dribbble' => 'https://dribbble.com/barcody',
            'behance' => 'https://behance.net/barcody',
        ]);

        $this->seedOne('inboxlists', ['email' => 'client.one@example.com'], [
            'name' => 'Client One',
            'email' => 'client.one@example.com',
            'phone' => '+201444444444',
            'message' => 'I would like to create QR invitations for a private event.',
        ]);

        $this->seedOne('inboxlists', ['email' => 'planner@example.com'], [
            'name' => 'Event Planner',
            'email' => 'planner@example.com',
            'phone' => '+201555555555',
            'message' => 'Can we import a large guest list from Excel?',
        ]);

        $this->seedLandingPageDemoData();
    }

    private function seedLandingPageDemoData()
    {
        $this->seedOne('plans', ['title' => 'Starter'], [
            'title' => 'Starter',
            'price' => 'Free',
            'item1' => 'Up to 50 guests',
            'item2' => 'QR invitation links',
            'item3' => 'Basic RSVP tracking',
            'item4' => 'One event',
            'item5' => 'Email support',
        ]);

        $this->seedOne('plans', ['title' => 'Professional'], [
            'title' => 'Professional',
            'price' => '$29',
            'item1' => 'Up to 500 guests',
            'item2' => 'WhatsApp invitations',
            'item3' => 'Live check-in dashboard',
            'item4' => 'Multiple events',
            'item5' => 'Priority support',
        ]);

        $this->seedOne('faqs', ['question' => 'Can I scan guests at the door?'], [
            'question' => 'Can I scan guests at the door?',
            'answer' => 'Yes, each guest can receive a unique QR invitation for check-in.',
        ]);

        $this->seedOne('faqs', ['question' => 'Can I import contacts?'], [
            'question' => 'Can I import contacts?',
            'answer' => 'Yes, the admin panel supports importing contact lists for events.',
        ]);

        $this->seedOne('herosections', ['name' => 'Barcody'], [
            'name' => 'Barcody',
            'title' => 'Smart QR invitations for modern events',
            'description' => 'Create invitations, manage guest lists, and track attendance from one dashboard.',
            'main_image' => 'hero-sections/demo-main.png',
            'image1' => 'hero-sections/demo-dashboard.png',
            'image2' => 'hero-sections/demo-phone.png',
        ]);

        $this->seedOne('information', ['name' => 'Barcody'], [
            'logo' => 'information-sections/logo.png',
            'name' => 'Barcody',
            'title' => 'Invite, respond, and check in faster',
            'description' => 'Demo content for the landing page and admin preview screens.',
            'icon1' => 'information-sections/icon-qr.svg',
            'title1' => 'QR invitations',
            'icon2' => 'information-sections/icon-rsvp.svg',
            'title2' => 'RSVP tracking',
            'icon3' => 'information-sections/icon-guests.svg',
            'title3' => 'Guest lists',
            'icon4' => 'information-sections/icon-dashboard.svg',
            'title4' => 'Dashboard',
            'image_app1' => 'information-sections/app-1.png',
            'image_app2' => 'information-sections/app-2.png',
            'main_image' => 'information-sections/main.png',
        ]);

        $this->seedOne('how_use_barcodies', ['title' => 'Create your event'], [
            'image' => 'how-use-barcodies/create-event.png',
            'title' => 'Create your event',
            'description' => 'Add the event details, date, location, and invitation style.',
        ]);

        $this->seedOne('how_use_barcodies', ['title' => 'Invite guests'], [
            'image' => 'how-use-barcodies/invite-guests.png',
            'title' => 'Invite guests',
            'description' => 'Upload contacts and send each guest a personalized QR invitation.',
        ]);

        $this->seedOne('invitation_categories', ['title' => 'Wedding'], [
            'image' => 'invitation-categories/wedding.png',
            'title' => 'Wedding',
        ]);

        $this->seedOne('invitation_categories', ['title' => 'Business'], [
            'image' => 'invitation-categories/business.png',
            'title' => 'Business',
        ]);
    }

    private function seedOne($table, array $keys, array $values)
    {
        if (! Schema::hasTable($table)) {
            return null;
        }

        $keys = $this->onlyExistingColumns($table, $keys);
        $values = $this->onlyExistingColumns($table, $values);

        if (empty($keys)) {
            return null;
        }

        $timestamps = [];

        if (Schema::hasColumn($table, 'created_at')) {
            $timestamps['created_at'] = now();
        }

        if (Schema::hasColumn($table, 'updated_at')) {
            $timestamps['updated_at'] = now();
        }

        DB::table($table)->updateOrInsert($keys, array_merge($values, $timestamps));

        $query = DB::table($table);

        foreach ($keys as $column => $value) {
            $query->where($column, $value);
        }

        return $query->value('id');
    }

    private function onlyExistingColumns($table, array $data)
    {
        return collect($data)
            ->filter(fn ($value, $column) => Schema::hasColumn($table, $column))
            ->all();
    }
}
