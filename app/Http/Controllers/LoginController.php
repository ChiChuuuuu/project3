<?php

namespace App\Http\Controllers;

use App\Models\StaffModel;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function process(Request $request)
    {

        try {
            $username = $request->get('username');
            $password = $request->get('password');
            $staff = StaffModel::where('username', $username)->where('password', $password)->firstOrFail();
            $request->session()->put('id', $staff->id);
            $request->session()->put('username', $staff->username);
            $request->session()->put('isAdmin', $staff->isAdmin);
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            return redirect()->route('login')->with('message', 'Sai ten tai khoan hoac mat khau');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('login');
    }
}
