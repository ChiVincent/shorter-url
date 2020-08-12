<?php

namespace Tests\Feature;

use App\Url;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Vinkla\Hashids\Facades\Hashids;

class RestorerTest extends TestCase
{
    use RefreshDatabase;

    public function test_base()
    {
        $url = factory(Url::class)->create();

        $response = $this->get(route('restorer', ['token' => Hashids::encode($url->id)]));

        $response->assertRedirect($url->url);
    }

    public function test_url_not_found()
    {
        $response = $this->get(route('restorer', ['token' => 0])); // Doesn't exist.
        $response->assertNotFound();
    }
}
