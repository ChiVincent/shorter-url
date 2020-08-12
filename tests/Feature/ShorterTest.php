<?php

namespace Tests\Feature;

use App\Url;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShorterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_base()
    {
        $response = $this->postJson(route('shorter'), [
            'url' => $url = $this->faker->url,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('urls', ['url' => $url]);
        $response->assertJson([
            'message' => 'shorter.success',
            'data' => [
                'original_url' => $url,
                'shorted_url' => config('app.url') . '/' . Url::where('url', $url)->first()->id,
            ],
        ]);
    }

    public function test_invalid_url()
    {
        $response = $this->postJson(route('shorter'), [
            'url' => $url = 'this-is-invalid-url',
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'url' => ['The url format is invalid.'],
            ],
        ]);
    }

    public function test_invalid_parameter()
    {
        $response = $this->postJson(route('shorter'), [
            'uri' => 'this-is-invalid-parameter-name',
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'url' => ['The url field is required.'],
            ],
        ]);
    }
}
