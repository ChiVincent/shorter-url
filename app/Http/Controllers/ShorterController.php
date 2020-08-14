<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;

class ShorterController extends Controller
{
    public function __invoke(Request $request, DatabaseService $service): array
    {
        $request->validate(['url' => 'required|url']);

        return [
            'message' => 'shorter.success',
            'data' => [
                'original_url' => $request->url,
                'shorted_url' => $service->shorter($request->url),
            ],
        ];
    }
}
