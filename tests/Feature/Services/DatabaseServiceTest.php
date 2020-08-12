<?php

namespace Tests\Feature\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\DatabaseService;
use App\Url;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function test_restorer()
    {
        $url = Url::create(['url' => $originalUrl = $this->faker->url]);
        $service = app(DatabaseService::class);

        $result = $service->restorer($url->id);

        $this->assertEquals($result, $originalUrl);
    }

    public function test_restorer_not_found()
    {
        $service = app(DatabaseService::class);

        $this->expectException(ModelNotFoundException::class);
        $service->restorer(1); // Doesn't exist.
    }
}
