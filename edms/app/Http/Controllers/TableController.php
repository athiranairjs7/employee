<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TableController extends Controller
{
    public function userDisplay(){
         $user_id = Auth::id();
         $user = roles::join('users','users.role_id','=','roles.id')
                  ->where('is_deleted','=',0)
                 //->where('id','==',$user_id)
                 ->get();
        
        if($user) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $user
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    public function delete(Request $request){
      
        $deleteduser= DB::table('users')->where('id',$request->id)->update([
            'is_deleted'=>1
        ]);
        if($deleteduser) {
            return response()->json([
                'message' => "User deleted succesfully",
                "code"    => 200,
                
            ]);
        return back()->with('User_deleted','User details deleted successfully');
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    public function edit(Request $request)
    {
        $result = User::where('id', $request->id)->first();     
        if($result) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    => $result
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    public function update(Request $request) {

        $user_id = Auth::id();

        $result = User::where('id', $request->id)->update([
            'id'  => $request->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'updated_by' => $user_id
        ]);

        if($result) {
            return response()->json([
                'message' => "Data Updated Successfully",
                "code"    => 200,
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    public function Active(Request $request){
        $user_id = Auth::id();

        $result = User::where('id', $request->id)->update([
            'is_active' => 1,
            'updated_by' => $user_id
        ]);

        if($result) {
            return response()->json([
                'message' => "Activated Successfully",
                "code"    => 200,
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    public function InActive(Request $request){
        $user_id = Auth::id();

        $result = User::where('id', $request->id)->update([
            'is_active' => 0,
            'updated_by' => $user_id
        ]);

        if($result) {
            return response()->json([
                'message' => "Deactivated Successfully",
                "code"    => 200,
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
}
