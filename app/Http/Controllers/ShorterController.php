<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShorterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['url' => 'required|string|url']);

        return [
            'message' => 'shorter.success',
            'data' => [
                'original_url' => $request->url,
            ],
        ];
    }
}
