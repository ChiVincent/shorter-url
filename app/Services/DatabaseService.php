<?php declare(strict_types=1);

namespace App\Services;

use App\Url;

class DatabaseService
{
    public function shorter(string $url): string
    {
        return $this->buildUrl($this->record($url));
    }

    public function restorer(string $token): string
    {
        return Url::findOrFail($this->decode($token))->url;
    }

    protected function record(string $url): Url
    {
        return Url::create(['url' => $url]);
    }

    protected function buildUrl(Url $url): string
    {
        // TODO: use route() instead of build by config('app.url')
        // TODO: Encode $url->id by hashid
        return config('app.url') . '/' . $url->id;
    }

    protected function decode(string $token): string
    {
        // TODO： Decode $token by hashid
        return $token;
    }
}
