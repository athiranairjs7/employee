<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Customer::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn text-info btn-sm editCustomer"><i class="fas fa-pencil-alt"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn text-danger btn-sm deleteCustomer"><i class="fas fa-times"></i></a>';
                
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('customer');
    }
    public function store(Request $request)
    {
        Customer::updateOrCreate(['id' => $request->Customer_id],
                ['firstName' => $request->firstName,'lastName' => $request->lastName,  'info' => $request->info]);        

        return response()->json(['success'=>'Customer saved successfully!']);
    }
    public function edit($id)
    {
        $Customer = Customer::find($id);
        return response()->json($Customer);
    }
    public function destroy($id)
    {
        Customer::find($id)->delete();
        return response()->json(['success'=>'Customer deleted!']);
    }
}
