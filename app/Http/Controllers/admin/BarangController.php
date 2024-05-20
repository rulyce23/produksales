<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Datatables;
 

class BarangController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Barang::select('*'))
            ->addColumn('action', 'admin.barang-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.indexBarang');
    }



    public function store(Request $request)
    {  
  
        $barangId = $request->id;
         $randomCode = 'A' . Str::random(5); // Panggil fungsi generateUniqueCode
        $barang = Barang::updateOrCreate(
            [
                'id' => $barangId
            ],
            [
                'nama' => $request->nama,
                'kode' => $randomCode,
                'harga' => $request->harga,
                'jenis' => $request->jenis
            ]);
                          
        return Response()->json($barang);
    }
 
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $barang  = Barang::where($where)->first();
       
        return Response()->json($barang);
    }
 
    public function destroy(Request $request)
    {
        $barang = Barang::where('id',$request->id)->delete();
       
        return Response()->json($barang);
    }

}