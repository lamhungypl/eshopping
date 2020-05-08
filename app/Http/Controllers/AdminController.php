<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
                echo 'failed';
                die;
            }
        }
        return view("admin.admin_login");
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
