<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Validation\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function home(): Renderable
    {
        return view('home');
    }

    /**
     * @throws ValidationException
     */
    public function update( Request $request )
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {

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
