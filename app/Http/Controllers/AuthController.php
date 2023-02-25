<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\Registration;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login', ['no_categories' => true]);
    }

    public function doLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $input = $request->only(['email', 'password']);

        $user = User::where([
            'email' => $input['email']
        ])->first();

        if(Hash::check($input['password'], $user->password))
        {
            $request->session()->put('logged', true);
            $request->session()->put('user', $user);

            return redirect()->route('news');
        }

        return back();
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

            Mail::to($user)->send(new Registration());
        }

        return redirect()->route('auth.login');
    }

    public function doLogout(Request $request)
    {
        $request->session()->forget('logged');
        $request->session()->forget('user');

        return redirect()->route('news');
    }

    public function isLogged()
    {
        return Session::get('logged');
    }
}
