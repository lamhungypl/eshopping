<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    //
    public function login(Request $request)
    {
        # code...
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                Session::put('frontSession', $data['email']);
                return redirect('/');
            } else {
                return redirect()->back()->with('flash_message_error', 'Invalid username or password.');
            }
        }
        return view('user.login');
    }
    public function register(Request $request)
    {
        # code...
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);

            $countUser = User::where('email', $data['email'])->count();
            if ($countUser > 0) {
                return redirect()->back()->with('flash_message_error', 'Email already existed');
            } else {
                $user = new User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {


                    return redirect('/');
                }
            }
        }
        return view('user.login');
    }
    public function checkEmail(Request $request)
    {
        # code...
        $data = $request->all();
        $countUser = User::where('email', $data['email'])->count();
        return $countUser > 0 ? "true" : "false";
    }
    public function logout()
    {
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }
    public function account(Request $request)
    {
        # code...
        return view('user.account');
    }
}
