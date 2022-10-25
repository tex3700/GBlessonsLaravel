<?php

namespace App\Services\Contracts;

use Laravel\Socialite\Contracts\User as SocialUser;

interface Social
{
    public function loginAndRedirectUser(SocialUser $socialUser, $driver): string;

}
