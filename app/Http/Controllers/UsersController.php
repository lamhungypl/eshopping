<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function login(Request $request)
    {
        # code...
        if ($request->isMethod('post')) {
            $data = $request->all();
            dd($data);
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
}
