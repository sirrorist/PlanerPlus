<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registrate(Request $request)
    {
        if(Auth::check())
        {
            return redirect(route('user.tasks'));
        }

        $validateData = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required'
        ]);

        if(User::where('name', $validateData['name'])->exists())
        {
            return redirect(route('user.register'))->withErrors([
                'name' => 'Пользователь уже существует'
            ]);
        }

        $user = User::create($validateData);
        if($user)
        {
            Auth::login($user);
            return redirect()->route('user.tasks');
        }

        return redirect()->route('user.login')->withErrors([
            'name' => 'Ошибка при регистрации, попробуйте снова'
        ]);
    }
}
