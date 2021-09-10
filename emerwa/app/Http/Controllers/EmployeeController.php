<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.add');
    }
    public function store(Request $request)
    {
        $rules = [
			'first_name' => 'required|string|min:3|max:255',
			'last_name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255|unique:employees'
            'phone' => 'required|string|min:3|max:12',
            'company_id'=>'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('insert')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$employee = new Employee;
                $employee->first_name = $data['first_name'];
                $employee->last_name = $data['last_name'];
				$employee->phone = $data['phone'];
				$employee->email = $data['email'];
                $employee->company_id=$data['company_id']
				$employee->save();
				return redirect('insert')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('insert')->with('failed',"operation failed");
			}
		}
    }
}
