<?php declare(strict_types=1);

namespace App\Services;

use App\Url;
use App\Contracts\URLExtractor;
use Vinkla\Hashids\Facades\Hashids;

class DatabaseService implements URLExtractor
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
        return route('restorer', ['token' => Hashids::encode($url->id)]);
    }

    protected function decode(string $token): ?int
    {
        return Hashids::decode($token)[0] ?? null;
    }
}
