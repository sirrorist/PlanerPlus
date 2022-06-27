<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::check())
        {
            return redirect()->intended(route('user.tasks'));
        }

        $data = $request->only(['name', 'password']);
        $user = User::where('name', '=', $data['name'])->first();

        if (!$user) 
        {
            return redirect()->route('user.login')->withErrors([
                'name' => 'Такого пользователя не существует.'
            ]);
        }
        if (!Hash::check($data['password'], $user['password']))
        {
            return redirect()->route('user.login')->withErrors([
                'password' => 'Неверный пароль.'
            ]);
        }

        if(Auth::attempt($data))
        {
            return redirect()->intended(route('user.tasks'));
        }

        return redirect()->route('user.login')->withErrors([
            'name' => 'Ошибка авторизации, данные заполнены неверно или такого пользователя не существует.'
        ]);
    }
}
