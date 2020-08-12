<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Url;

class RestorerTest extends TestCase
{
    use RefreshDatabase;

    public function test_base()
    {
        $url = factory(Url::class)->create();

        $response = $this->get(route('restorer', ['token' => $url->id]));

        $response->assertRedirect($url->url);
    }

    public function test_url_not_found()
    {
        $response = $this->get(route('restorer', ['token' => 0])); // Doesn't exist.
        $response->assertNotFound();
    }
}
