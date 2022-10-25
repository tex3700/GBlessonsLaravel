<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function update( Request $request ): Factory|View|RedirectResponse|Application
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {

            $this->validate($request, $this->validateRules(), [], $this->attributesName());

            $errors = [];
            if (Hash::check($request->post('password'), $user->password)) {

                $user->fill([
                    'name' => $request->post('name'),
                    'password' => Hash::make($request->post('newPassword')),
                    'email' => $request->post('email'),
                ])->save();

                $request->session()->flush('MSG', 'Данные сохранены');

                return redirect()->route('home')
                    ->with('success', __('messages.admin.profile.update.success'));
            } else {
                $errors['password'][] = 'Неверно введен текущий пароль';
            }

            return redirect()->route('account.update')->withErrors($errors);
        }

        return view('account.update', [
            'user' => $user,
            'title_page' => 'Редактор профиля пользователя',
            'route' => 'account.update',
        ]);
    }

    protected function validateRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required'],
            'newPassword' => ['required', 'string', 'min:8'],
        ];
    }

    protected function attributesName(): array
    {
        return [
            'newPassword' => 'Новый пароль',
        ];
    }
}
