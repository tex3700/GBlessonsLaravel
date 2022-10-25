<?php

namespace App\Http\Controllers;

use App\Services\Contracts\Social;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Foundation\Application;

class SocialController extends Controller
{
    public function redirect(string $driver): SymfonyRedirectResponse|RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback(string $driver, Social $social): Redirector|Application|RedirectResponse
    {
        return redirect($social
            ->loginAndRedirectUser(Socialite::driver($driver)->user(), $driver));
    }
}
