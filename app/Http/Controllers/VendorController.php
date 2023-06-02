<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;
use Auth;
class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = vendor::get();
        return view('5vendor.table',compact('data'));
    }
    public function buat()
    {
        $vendor= vendor::count();
        return view('5vendor.buat',compact('vendor'));

    }
    public function simpan(request $request)
    {
        // dd($request->all());
        $validasi = vendor::where('nik','LIKE','%'.$request->nik.'%')
        ->where('npwp','LIKE','%'.$request->npwp.'%')->where('telp','LIKE','%'.$request->telp.'%')
        ->where('norek','LIKE','%'.$request->norek.'%')->count();

        // dd($validasi);
        if($validasi > 0 )
        {
            alert()->error('Gagal','Data Vendor Sudah Ditambahkan');
            return redirect('/vendors/form');
        }
        else {

        
        $vendor = new vendor;
        $vendor->kode_vendor = $request->k_vendor;
        $vendor->nik = $request->nik;
        $vendor->npwp = $request->npwp;
        $vendor->nama_pemilik = $request->n_pemilik;
        $vendor-> nama_vendor = $request->n_vendor;
        $vendor-> telp = $request-> telp;
        $vendor->alamat = $request->alamat;
        $vendor-> bank = $request->bank;
        $vendor->norek = $request->norek;
        
        $foto1 = $request->f_nik;
        $nktp = rand(11111, 99999).'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $request->f_nik->storeAs('thumbnail',$nktp);//memindahkan data ke public
        $foto1->move('images/',$nktp); //memindahkan gambar ke directory pribadi
        $vendor->f_nik = $nktp; //menyimpan ke data base

        $fnpwp = $request->f_npwp;
        $npwp = rand(11111, 99999).'.'.$fnpwp->getClientOriginalExtension(); //pembuatan nama file
        $request->f_npwp->storeAs('thumbnail',$npwp);//memindahkan data ke public
        $fnpwp->move('images/',$npwp); //memindahkan gambar ke directory pribadi
        $vendor->f_npwp = $npwp; //menyimpan ke data base

        $foto3 = $request->f_buku;
        $tabungan = rand(11111, 99999).'.'.$foto3->getClientOriginalExtension(); //pembuatan nama file
        $request->f_buku->storeAs('thumbnail',$tabungan);//memindahkan data ke public
        $foto3->move('images/',$tabungan); //memindahkan gambar ke directory pribadi
        $vendor->f_tabungan = $tabungan; //menyimpan ke data base
        
        $vendor->save();
        alert()->success('Success','Data Vendor Berhasil Ditambahkan');
        return redirect('/vendors')->with('terima','Data Sucessfully added ');
        }
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
        $hapus = vendor::findorfail($id)->delete();
        // $hps = $hapus->destroy();
        alert()->success('Success','Data Vendor Berhasil Dihapus');
        return redirect('/vendors');
    }
}
