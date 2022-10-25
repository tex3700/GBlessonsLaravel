<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\Social;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialService implements Social
{

    /**
     * @throws Exception
     */
    public function loginAndRedirectUser(SocialUser $socialUser, $driver): string
    {
        switch ($driver) {
            case 'vkontakte':
                $driver = 'vk';
                break;
            case 'github' :
                $driver = 'git';
                break;
        }

        $userInData = User::query()->where('email', '=', $socialUser->getEmail())->first();

        $user = User::updateOrCreate([
            'email' => $socialUser->getEmail(),
        ], [
            'name' => !empty($socialUser->getName()) ? $socialUser->getName() : '',
            'email' => !empty($socialUser->getEmail()) ? $socialUser->getEmail() : '',
            'password' => !is_null($userInData) ? $userInData->password : '',
            'type_auth' => $driver,
            'id_in_soc' => !empty($socialUser->getId()) ? $socialUser->getId() : '',
            'avatar' => !empty($socialUser->getAvatar()) ? $socialUser->getAvatar() : '',
        ]);

        Auth::login($user);

        return route('home');
    }
}
