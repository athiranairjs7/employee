<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\Employees;
class EmployeeController extends Controller
{
    function employee(){
        if(Auth::check()){
            $country = DB::table('country')->get();
            $state=DB::table('state')->get();
            return view('admin.employee',compact('country','state'));
        }
        return redirect("")->withSuccess('You are not allowed to access');
       
    }
    function NewEmployee(){
        $country = DB::table('country')->get();
        return view('admin.employeeadd',compact('country'));
     }
     public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                    ->get(["state_name","state_id"]);
        return response()->json($data);
    }
    function create(Request $request){
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:employees',
            'address'=>'required',
            'gender'=>'required',
            'dateofjoining'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'pincode'=>'required'
        ]);
        $userid=Auth::id();
        $user = new Employees();
        $user->salutation =$request->salutation;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->dateofjoining = $request->dateofjoining;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city=$request->city;
        $user->pincode=$request->pincode;
        $user->created_by = $userid;
        $query= $user->save();
        if($query){
            return back()->with('success','Sucessfully Added');
        }
        else{
            return back()->with('fail','something went wrong');
        }
    }
    public function userDisplay(){
        $user = DB::table('employees')
        ->join('country','employees.country_id','=','country.country_id')
        ->join('state','employees.state_id','=','state.state_id')
        ->where('is_deleted','=',0)
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
   public function edit(Request $request)
    {
        $result = Employees::where('id', $request->id)->first();     
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

        $result = Employees::where('id', $request->id)->update([
            'id'  => $request->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'address' => $request->address,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city'=>$request->city,
            'pincode'=>$request->pincode,
            'dateofjoining'=>$request->dateofjoining,
            'gender'=>$request->gender,
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
    public function delete(Request $request){
      
        $deleted= DB::table('employees')->where('id',$request->id)->update([
            'is_deleted'=>1
        ]);
        if($deleted) {
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
}
