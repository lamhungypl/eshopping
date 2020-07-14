<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $countries = Country::get();
        $userId = Auth::user()->id;

        $userDetails = User::find($userId);
        // dd($userDetails);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $userDetails->name = !empty($data['name']) ? $data['name'] : $userDetails->name;
            $userDetails->email = !empty($data['email']) ? $data['email'] : $userDetails->email;
            $userDetails->address = !empty($data['address']) ? $data['address'] : $userDetails->address;
            $userDetails->city = !empty($data['city']) ? $data['city'] : $userDetails->city;
            $userDetails->state = !empty($data['state']) ? $data['state'] : $userDetails->state;
            $userDetails->country = !empty($data['country']) ? $data['country'] : $userDetails->country;
            $userDetails->pin_code = !empty($data['pincode']) ? $data['pincode'] : $userDetails->pin_code;
            $userDetails->mobile = !empty($data['mobile']) ? $data['mobile'] : $userDetails->mobile;

            if (!empty($data['password'])) {
                if (Hash::check($data['password'], $userDetails->password)) {
                    $userDetails->password = $data['password'];
                } else {
                    return redirect()->back()->with('flash_message_error', 'Incorrect password.');
                }
            }

            $userDetails->save();
            return redirect()->back()->with('flash_message_success', 'updated successfully');
        }


        return view('user.account')->with(compact('countries', 'userDetails'));
    }
}
