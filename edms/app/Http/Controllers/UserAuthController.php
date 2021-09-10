<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use PhpParser\Node\Stmt\Return_;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\Environment\Console;

class UserAuthController extends Controller
{
    function login(){
        return view('auth.login');
    }
    
    // login
    public function check(Request $request){
       $request->validate([
        'email'=>'required|email',
        'password'=>'required'
       ]);
      
       if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 1,'is_deleted'=>0,'is_active'=>1])) {
           return redirect()->intended('profile')
                            ->withSuccess('LoggedUser');
       }
       else if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 2,'is_deleted'=>0,'is_active'=>1])) {
           return redirect()->intended('auditor');
                            
       }
       return redirect("")->withSuccess('Login details are not valid');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('');
    }
}
