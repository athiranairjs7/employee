<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\DataTables\UserDataTable;
class AdminController extends Controller
{
    function profile(){
        if(Auth::check()){
            $userid = Auth::id();
            return view('admin.profile',compact('userid'));
        }
  
        return redirect("")->withSuccess('You are not allowed to access');
       
    }
    function user(){
        if(Auth::check()){
            $roles = DB::table('roles')->get();
            return view('admin.user',compact('roles'));
        }
        return redirect("")->withSuccess('You are not allowed to access');
       
    }
    function NewUser(){
       $role = DB::table('roles')->get();
       return view('admin.adduser',compact('role'));
    }
    
    function create(Request $request){
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users',
            'role_id'=>'required',
            'password'=>'required'
        ]);
        $userid=Auth::id();
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password =hash::make ($request->password);
        $user->created_by = $userid;
        $query= $user->save();
        if($query != null) {
            Mail::send('mail.signup-email', $user->toArray(),
            function($message){
                $message->to('atthiranairjs7@gmail.com', 'Athira')->subject('This is your confirmation mail');
            });
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong'));
        if($query){
            return back()->with('success','Sucessfully Added');
        }
        else{
            return back()->with('fail','something went wrong');
        }
    }
   

}
