<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_displays_added_events_even_when_their_date_is_in_the_past(): void
    {
        $category = Category::create([
            'name' => 'Seminar',
            'slug' => 'seminar',
        ]);

        Event::create([
            'category_id' => $category->id,
            'title' => 'Seminar Laravel',
            'description' => 'Agenda belajar Laravel.',
            'date' => '2026-05-01 10:00:00',
            'location' => 'Online',
            'price' => 50000,
            'stock' => 100,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Seminar Laravel');
    }
}
