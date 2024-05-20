<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Datatables;
 
class CustomerController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Customer::select('*'))
            ->addColumn('action', 'admin.customer-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.indexCustomer');
    }



    public function store(Request $request)
    {  
        $request->validate([
            'nama' => 'required|unique:customers,nama', 
            'nik' => 'required|unique:customers,nik', 
            'tgl_lahir' => 'required|unique:customers,tgl_lahir',
            ]);

         $customerId = $request->id;
        //  $randomCode = 'A' . Str::random(5); // Panggil fungsi generateUniqueCode
         $customer = Customer::updateOrCreate(
            [
                'id' => $customerId
            ],
            [
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'goldar' => $request->goldar,
                'nik' => $request->nik,
                'tgl_lahir' => $request->tgl_lahir,
                'jk' => $request->jk,               
                'kode' =>$request->kode,
                
            ]);
                          
        return Response()->json($customer);
    }
 
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $customer  = Customer::where($where)->first();
       
        return Response()->json($customer);
    }
 
    public function destroy(Request $request)
    {
        $customer = Customer::where('id',$request->id)->delete();
       
        return Response()->json($customer);
    }
}