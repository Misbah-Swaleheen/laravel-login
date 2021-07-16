<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    use AuthenticatesUsers;

    // public function __construct()
    // {
    //     $this->middleware('auth');
      
    // }
    public function registerAdmin(Request $r)
    {
        $r->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:admins,email',
            'password' =>'required|min:8|max:12',
           
        ]);

        $password =  $r->password;
$hashed = Hash::make($password);
        $data = new Admin;
        $data->name = $r->name;
        $data->email = $r->email;
        $data->password = $hashed;
        $data->is_admin =1;
        $data->save();
        return redirect()->back()->with(['message' => 'User created successfully']);
    }


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email','password'))) {

            return redirect()->route('admin.index');
            
        }
        return redirect()->back()->with(['message' => 'password and email are not matched']);
        
    }

    function logoutAdmin(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

}
