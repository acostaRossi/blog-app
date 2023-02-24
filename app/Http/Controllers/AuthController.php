<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login', ['no_categories' => true]);
    }

    public function doLogin(): View
    {
        // TODO
    }

    public function register(): View
    {
        return view('auth.register', ['no_categories' => true]);
    }

    public function doRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $input = $request->only(['name', 'surname', 'email', 'password']);

        $input['password'] = bcrypt($input['password']);

        $user = User::where('email', $input['email'])->get();        

        // if user already exists
        if(!$user->isEmpty())
        {
            return redirect()->route('auth.register-error');
        }

        $input['remember_token'] = Str::random(40);
        
        $createdUser = User::create($input);

        if($createdUser)
        {
            $msg = "Thank you for registering.</br>
                    We have sent you an email.";

            $emailLink = $this->sendEmail($createdUser);

            $msg .= "</br> $emailLink";

            return view('auth.register-success')->with('msg', $msg);
        }
    }

    public function registrationSuccess(): View
    {
        return view('auth.register-success', []);
    }

    public function registrationError(): View
    {
        return view('auth.register-error', []);
    }

    private function sendEmail($user)
    {
        return route('auth.register-confirm', ['id' => $user->id, 'token' => $user->remember_token]);
    }

    public function registrationConfirm($id, $token)
    {
        $user = User::find($id);

        if($user && $user->remember_token === $token)
        {
            $user->email_verified_at = now();
            $user->save();
        }

        return redirect()->route('auth.login');
    }
}
