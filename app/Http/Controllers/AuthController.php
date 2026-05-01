<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email|unique:users',
            'username' => 'required|max:255',
            'password' => [
                            'required',
                            'same:confiremd_password',
                            Password::min(6)->letters()->numbers()->symbols()
                        ],
        ]);

        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => implode("<br>", $validator->errors()->all()) ] );
        }

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        auth()->login($user);

        return response()->json( [ 'success' => "Registration successful", 'url' => url('/blogs') ]);
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => implode('<br', $validator->errors()->all())]);
        }

        $user['email'] = $request->email;
        $user['password'] = $request->password;

        if(!auth()->attempt($user)) {
            return response()->json(['errors' => "Invalid credentials!"]);
        } else {
            $request->session()->regenerate();
            return response()->json( [ 'success' => "Login successful", 'url' => url('/blogs') ]);
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/blogs');
    }
}
