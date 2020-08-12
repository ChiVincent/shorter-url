<?php declare(strict_types=1);

namespace App\Services;

use App\Url;
use Vinkla\Hashids\Facades\Hashids;

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
        return config('app.url') . '/' . Hashids::encode($url->id);
    }

    protected function decode(string $token): ?int
    {
        return Hashids::decode($token)[0] ?? null;
    }
}
