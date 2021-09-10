<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
   public function index(){
       
       return view('company.index');
   }
   public function ajax(){
    $result=DB::table('company')->where('is_deleted',0)->get();
    if($result){
        return response()->json([
            'message' =>"Data Found",'code'=>200,'data'=>$result
        ]);
    }
    else{
        return response()->json([
            'message' =>"Internal serve error",'code'=>500
        ]);
    }
   }
   public function allindex(){
       
       return view('company.indexall');
   }
   public function allajax(){
    $result=DB::table('company')->get();
    if($result){
        return response()->json([
            'message' =>"Data Found",'code'=>200,'data'=>$result
        ]);
    }
    else{
        return response()->json([
            'message' =>"Internal serve error",'code'=>500
        ]);
    }
   }
   public function Active(Request $request){

    $result =DB::table('company')->where('id',$request->id)->update([
        'is_deleted'=>0
    ]);
    if($result) {
     return response()->json([
         'message' => "Company deleted succesfully",
         "code"    => 200,
         
     ]);
 return back()->with('message','Company Activated successfully');
 } 
 else  {
     return response()->json([
         'message' => "Internal Server Error",
         "code"    => 500
     ]);
 }
}
   public function getCreateForm(){
       return view('company.add');
   }
   public function create(Request $request){
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:company',
        'website'=>'required|url',
        'image' =>'required|image',
    ]);
    $company = new Company();
    
    $company->name=$request->name;
    $company->email=$request->email;
    $company->website=$request->website;
    $imageName = time().'.'.$request->file('image')->guessExtension();
    $request->image->move(public_path('upload'),$imageName);
    $company->image = $imageName;
    $company->save();
    return redirect('company')->with('message', 'Company Details Added Successfully!');
   }
   public function getCompanyById($companyId){
     $company_details = DB::table('company')->where('id',$companyId)->first();
     return view('company.edit',compact('company_details'));
   }
   public function update(Request $request){
       
     Company::where('id', $request->id)->update([
       
        'name' => $request->name,
        'website' => $request->website,
        'email' => $request->email,
    ]);
    return redirect('company')->with('message', 'Company Details Updated Successfully!');
    
   }
   public function delete(Request $request){
       $result =DB::table('company')->where('id',$request->id)->update([
           'is_deleted'=>1
       ]);
       if($result) {
        return response()->json([
            'message' => "Company deleted succesfully",
            "code"    => 200,
            
        ]);
    return back()->with('message','Company details deleted successfully');
    } 
    else  {
        return response()->json([
            'message' => "Internal Server Error",
            "code"    => 500
        ]);
    }
   }
}
