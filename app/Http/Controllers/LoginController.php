<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function authenticate(ServerRequestInterface $request) {
        $data = $request->getParsedBody();
        $credentials = ['email' => $data['email'], 'password' => $data['password']];
        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->route('manage-reports');
        }
        return redirect()->route('home-page')->withErrors(['auth-error' => 'Wrong E-mail or Password']);
    }

    function logout() {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('home-page')->with('logout-success', 'Youre logged out.');
    }
}
