<?php declare(strict_types=1);

namespace App\Contracts;

interface URLExtractor
{
    public function shorter(string $url): string;
    public function restorer(string $token): string;
}