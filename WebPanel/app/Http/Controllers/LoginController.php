<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $checkRules = array(
            'username' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $checkRules);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $credentials = $request->only('username', 'password');
            $remember = $request->input('rememberCheckbox');

            if (Auth::attempt($credentials, $remember)) {
                return redirect()->intended('welcome');
            } else {
                return redirect()->back()
                    ->withErrors(['msg' => 'Invalid username or password!'])
                    ->withInput($request->except('password'));
            }
        }
    }
}
