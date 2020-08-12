<?php

namespace Tests\Feature\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\DatabaseService;

class DatabaseServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_shorter()
    {
        $url = $this->faker->url;
        $service = app(DatabaseService::class);

        $result = $service->shorter($url);

        $this->assertDatabaseHas('urls', ['url' => $url]);
        $this->assertStringStartsWith(config('app.url'), $result);
    }
}
