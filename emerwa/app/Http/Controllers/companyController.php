<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
class companyController extends Controller
{
    public function newcompany(){
        return view('company.add');
    }
    public function createCompany(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:companies',
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
        return redirect('/company');
        
     }
     //display
     public function company(){
         return view('company.index');
     }
     public function companyDisplay(){
        $company = DB::table('companies')->get();
       
       if($company) {
           return response()->json([
               'message' => "Data Found",
               "code"    => 200,
               "data"  => $company
           ]);
       } else  {
           return response()->json([
               'message' => "Internal Server Error",
               "code"    => 500
           ]);
       }
   }
   //edit
   public function edit(Request $request){
       $result = Company::where('id',$request->id)->first();
       if($result) {
        return response()->json([
            'message' => "Data Found",
            "code"    => 200,
            "data"    => $result
        ]);
            } 
    else  {
        return response()->json([
            'message' => "Internal Server Error",
            "code"    => 500
        ]);
    }
   }
   public function update(Request $request) {
    $result = Company::where('id', $request->id)->update([
        'id'  => $request->id,
        'name' => $request->name,
        'website' => $request->website,
        'email' => $request->email
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

public function deleteCompany(Request $request){
  $result = DB::table('companies')->where('id',$request->id)->delete();
  if($result) {
    return response()->json([
        'message' => "User deleted succesfully",
        "code"    => 200,
        
    ]);
        return back()->with('User_deleted','User details deleted successfully');
}
 else  {
    return response()->json([
        'message' => "Internal Server Error",
        "code"    => 500
    ]);
}
}
}
