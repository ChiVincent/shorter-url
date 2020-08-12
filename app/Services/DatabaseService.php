<?php declare(strict_types=1);

namespace App\Services;

use App\Url;
use Illuminate\Support\Str;

class DatabaseService
{
    public function shorter(string $url): string
    {
        return $this->buildUrl($this->record($url));
    }

    public function restorer(string $token): string
    {
        return '';
    }

    protected function record(string $url): Url
    {
        return Url::create(['url' => $url]);
    }

    protected function buildUrl(Url $url): string
    {
        // TODO: use route() instead of build by config('app.url')
        // TODO: Use hashid instead of $url->id,
        return config('app.url') . '/' . $url->id;
    }
}