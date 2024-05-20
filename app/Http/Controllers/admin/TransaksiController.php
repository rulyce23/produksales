<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DataTables; // Tambahkan impor untuk DataTables
use App\Models\Transaksi;
use App\Models\TSalesDet;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(DB::table('t_sales_detail')
            ->join('t_sales', 't_sales_detail.id_sales', '=', 't_sales.id')
            ->join('m_customer', 't_sales.id_cust', '=', 'm_customer.id')
            ->join('m_barang', 't_sales_detail.id_barang', '=', 'm_barang.id')
            ->select(
                't_sales.id',
                't_sales.kode',
                't_sales.tgl',
                'm_customer.nama as nama',
                't_sales_detail.qty',
                't_sales.subtotal',
                't_sales.diskon',
                't_sales.ongkir',
                't_sales.total_bayar'
            )
            ->get())
            ->addColumn('action', 'admin.transaksi-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.indextransaksi');
    }
    

    public function indexUser()
    {
        if (request()->ajax()) {
            return DataTables::of(DB::table('t_sales_detail')
            ->join('t_sales', 't_sales_detail.id_sales', '=', 't_sales.id')
            ->join('m_customer', 't_sales.id_cust', '=', 'm_customer.id')
            ->join('m_barang', 't_sales_detail.id_barang', '=', 'm_barang.id')
            ->select(
                't_sales.id',
                't_sales.kode',
                't_sales.tgl',
                'm_customer.nama as nama',
                't_sales_detail.qty',
                't_sales.subtotal',
                't_sales.diskon',
                't_sales.ongkir',
                't_sales.total_bayar'
            )
            ->get())
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.indextransaksiUser');
    }
    
    
    

    public function create()
    {
        $akun = DB::table('m_customer')->orderBy('kode', 'ASC')->get();
        $barang = DB::table('m_barang')->orderBy('kode', 'ASC')->get();
        
        return view('admin.createTransaksi', ['akun' => $akun,'barang'=>$barang]);
    }

    public function store(Request $request)
    {
        // Simpan data penjualan

        $lastTransaction = Transaksi::latest()->first();
        $lastCode = $lastTransaction ? $lastTransaction->kode : null;
        
        // Dapatkan tahun dan bulan saat ini
        $currentDate = now();
        $yearMonth = $currentDate->format('Ym');
        
        // Tentukan nomor urutan berikutnya
        $codeNumber = $lastCode ? intval(substr($lastCode, -4)) + 1 : 1;
        
        // Format nomor urutan dengan panjang 4 digit dan tambahkan ke kode transaksi
        $codeNumberFormatted = str_pad($codeNumber, 4, '0', STR_PAD_LEFT);
        $kodeTransaksi = $yearMonth . '-' . $codeNumberFormatted;


        $sales = new Transaksi();
        $sales->id_cust = $request->id_cust;
        $sales->tgl = $request->tgl;
        $sales->kode = $kodeTransaksi;
        $sales->subtotal = $request->subtotal;
        $sales->diskon = $request->diskon;
        $sales->ongkir = $request->ongkir;
        $sales->total_bayar = $request->total_bayar;
        $sales->save();
    
        // Simpan detail penjualan
        foreach ($request->kode as $key => $value) {
            $detail = new TSalesDet();
            $detail->id_sales = $sales->id[$key];
            $detail->id_barang = $request->id_barang[$key];
            $detail->qty = $request->qty[$key];
            $detail->harga_bandrol = $request->harga_bandrol[$key];
            $detail->diskon_pct = $request->diskon_pct[$key];
            $detail->diskon_nilai = $request->diskon_nilai[$key];
            $detail->harga_diskon = $request->harga_diskon[$key];
            $detail->total = $request->total[$key];
            $detail->save();
        }
    
        // Redirect ke halaman tertentu
        // return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil disimpan.');
        // Atau jika ingin kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Data penjualan berhasil disimpan.');
    }

}