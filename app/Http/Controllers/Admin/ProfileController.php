<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use JetBrains\PhpStorm\ArrayShape;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user ): Factory|View|RedirectResponse|Application
    {

        if ($request->isMethod('POST')) {

            $this->validate($request, $this->validateRules(), [], $this->attributesName());

            if ($user->fill([
                'name' => $request->post('name'),
                'password' => is_null($request->post('newPassword'))
                    ? $user->password
                    : Hash::make($request->post('newPassword')),
                'email' => $request->post('email'),
                'isAdmin' => $request->post('isAdmin'),
            ])->save()) {

                return redirect()->route('admin.profile.index')
                    ->with('success', __('messages.admin.profile.update.success'));
            }

            return back()->with('error', __('messages.admin.profile.update.fail'));
        }

        return view('admin.profile.update', [
            'user' => $user,
            'title_page' => 'Изменение профиля пользователя',
            'route' => 'admin.profile.update',
        ]);
    }

    protected function validateRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            //'newPassword' => ['string', 'min:8'],
            'isAdmin' => ['required'],
        ];
    }

    protected function attributesName(): array
    {
        return [
            'newPassword' => 'Новый пароль',
        ];
    }

    public function destroy(User $user): JsonResponse
    {
        try {
            $deleted =  $user->delete();
            if ($deleted === false) {
                return response()->json( "error", 400);
            }
            return response()->json("ok");
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json( "error", 400);
        }
    }

}
