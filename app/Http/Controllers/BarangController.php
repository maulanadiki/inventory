<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\stock;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use Image;
use Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $login = Auth::User()->first();
        $data = barang::get();
        $name = [];
        $size = [];
        $color=[];

        foreach($data as $brg){
            $name[] = $brg->nama_barang;
            $color[]= $brg->warna;
            $size[] = $brg->ukuran;
        }
        $nabar = array_unique($name);
        $warna= array_unique($color); 
        $ukuran = array_unique($size);
        
        return view ('4barang.tablebarang',compact('data'),['nabar'=>$nabar,'warna'=>$warna,'ukuran'=>$ukuran]);
    }
    public function buat()
    {$login = Auth::User()->first();
        $barang= barang::count();
        return view('4barang.buat',compact('barang','login'));
    }
    public function simpan(request $request)
    {
        $validated = $request->validate([
            'fbarang' =>'mimes:jpg,bmp,png'
        ]);
        $barang = new barang;
        $barang->kode_barang = $request->kbarang;
        $barang->nama_barang = $request->nbarang;
        $barang->warna = $request->warna;
        $barang->ukuran = $request->ukuran;
        $barang-> beli = $request->beli;
        $barang-> deskripsi = $request-> deskripsi;
        $foto1 = $request->fbarang;
        $namafile1 =  rand(11111, 99999).'.'.$foto1->getClientOriginalExtension(); 
        $request->fbarang->storeAs('thumbnail',$namafile1);
        $foto1->move('images/',$namafile1); 
        $barang->f_barang = $namafile1; 
        $barang->aktivasi_pembelian = 'enable';
        $barang->aktivasi_penjualan = 'enable';
        // dd($request->kbarang);

        $good = new stock;
        $good->kode_barang= $request->kbarang;
        $good->kuantitas = 0;
        $good->created_at= date("Y/m/d");
        $good->save();
        $barang->save();
        
        alert()->success('Success','Barang Berhasil di tambahkan');
        return redirect('/barang')->with('terima','Data Sucessfully added ');
    }

    public function stok()
    {
        $login = Auth::User()->first();
        $data = barang::leftJoin('stockgood','stockgood.kode_barang','=','barang.kode_barang')
        ->orderBy('kuantitas','Desc')->get();
        return view('4barang.stok',compact('data','login'));
    }

    public function ubah(request $request){
       

        if($request->ajax()){
            if($request->warna == null){
                $warna = Barang::where('nama_barang','LIKE','%'.$request->nabar.'%')->get();
                return response()->json(['warna'=>$warna]);
            
            }
            else{
                $ukuran = Barang::where('nama_barang','LIKE','%'.$request->nabar.'%')->where('warna','LIKE','%'.$request->warna.'%')->get();
                return response()->json(['ukuran'=>$ukuran]);
            }

        }
    }

    public function ubahsimpan(request $request){
        $cari = barang::where('nama_barang','LIKE','%'.$request->nama_barang.'%')
        ->where('warna','LIKE','%'.$request->warna_barang.'%')
        ->where('ukuran','LIKE','%'.$request->ukuran_barang.'%')
        ->first();
        $harga = str_replace('.','', $request->harga);
        $code = $cari->kode_barang;
        $update_penjualan = barang::where('kode_barang',$code)->update(['aktivasi_pembelian' => 'disable']);

        $kobar = barang::max('kode_barang');
        $kode = str_replace('BRG-','',$kobar);
        $kode_barang = "BRG-".str_pad((int)$kode + 1, 5, 0, STR_PAD_LEFT);
        $barang = new barang;
        $barang->kode_barang = $kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->warna = $request->warna_barang;
        $barang->ukuran = $request->ukuran_barang;
        $barang->beli = $harga;
        $barang->deskripsi = $request->desk;
        $barang->f_barang = $cari->f_barang;
        $barang->aktivasi_pembelian = 'enable';
        $barang->aktivasi_penjualan = 'enable';


        $good = new stock;
        $good->kode_barang= $kode_barang;
        $good->kuantitas = 0;
        $good->created_at= date("Y/m/d");
        $good->save();
        $barang->save();
        alert()->success('Success','Barang Berhasil di tambahkan');
        return redirect('/barang')->with('terima','Data Sucessfully added ');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
