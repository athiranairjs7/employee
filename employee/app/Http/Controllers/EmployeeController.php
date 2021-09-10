<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{
    public function index(){
        return view('employee.index');
    }

    public function ajaxemployee(){
        $result = DB::table('employee')
                  ->join('company','employee.company_id','=','company.id')
                  ->get();
                  
        if($result) {
        return response()->json([
            'message' => "Data Found",
            "code"    => 200,
            "data"  => $result
        ]);
    } else  {
        return response()->json([
            'message' => "Internal Server Error",
            "code"    => 500
        ]);
    }
    }

    public function getemployeeForm(){
        $company = DB::table('company')->where('is_deleted',0)->get();
        return view('employee.add',compact('company'));
    }

    public function create(Request $request){
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'employee_email'=>'required|email|unique:employee',
            'phone'=>'required|regex:/[0-9]{10}/',
            'company_id' =>'required',
        ]);
        $employee = new Employee();
        
        $employee->firstname=$request->firstname;
        $employee->lastname=$request->lastname;
        $employee->employee_email=$request->employee_email;
        $employee->phone=$request->phone;
        $employee->company_id = $request->company_id;
        $employee->save();
        return redirect('employee')->with('message', 'Employee Details Added Successfully!');
       }

    public function getEmployeeById($employeeId)
    {
        $company = DB::table('company')->where('is_deleted',0)->get();
        $employee_details = DB::table('employee')->where('empid',$employeeId)->first();
        return view('employee.edit',compact('employee_details','company'));
      }
    
    public function update(Request $request){
        Employee::where('empid', $request->empid)->update([
       
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'employee_email' => $request->employee_email,
            'company_id'=>$request->company_id,
        ]);
        return redirect('employee')->with('message', 'Employee Details Updated Successfully!');
        
    }
    public function delete(Request $request){
        $result =DB::table('employee')->where('empid',$request->empid)->delete();
        if($result) {
         return response()->json([
             'message' => "Company deleted succesfully",
             "code"    => 200,
             
         ]);
     return back()->with('message','Employee details deleted successfully');
     } 
     else  {
         return response()->json([
             'message' => "Internal Server Error",
             "code"    => 500
         ]);
     }
    }
}
