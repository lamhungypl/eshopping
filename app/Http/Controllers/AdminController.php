<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\User;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {

        if ($request->isMethod('POST')) {
            # code...
            $data = $request->input();
            if (Auth::attempt(['email' => $data['username'], 'password' => $data['password'], 'admin' => '1'])) {
                # code...
                // echo 'success';
                // die;
                return redirect('/admin/dashboard');
            } else {
                // echo 'failed';
                // die;
                return redirect('/admin/')->with('flash_message_error', 'Invalid username or password');
            }
        }
        return view("admin.admin_login");
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function logout()
    {
        Session::flush();
        return redirect('/admin/')->with('flash_message_logout', 'Logged out');
    }
    public function settings()
    {
        return view('admin.settings');
    }
    public function checkPassword(Request $request)
    {
        $data = $request->all();

        $currentPassword = $data['currentPassword'];
        $checkPass  = User::where(['admin' => '1'])->first();
        if (Hash::check($currentPassword, $checkPass->password)) {
            echo "true";
            die;
        } else {
            echo "false";
            die;
        }
    }
}
