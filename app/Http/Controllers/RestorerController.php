<?php

namespace App\Http\Controllers;

use App\Services\DatabaseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class RestorerController extends Controller
{
    public function __invoke(string $token, DatabaseService $service): RedirectResponse
    {
        return Redirect::to($service->restorer($token));
    }
}
