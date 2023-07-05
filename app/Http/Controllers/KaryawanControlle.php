<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\employe;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use File;
use Image;


class KaryawanControlle extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employe = employe::get();
        return view('7karyawan.table',compact('employe'));
    }

    public function akses()
    {
        return view('7karyawan.akses');
    }

    public function simpan(request $request)
    {
        $email = $request->email;
        $nik =$request->nik;
        $npwp =$request->npwp;
        $validasi = db::table('employe')
        ->where('email','LIKE',"%".$email."%")
        ->where('nik','LIKE',"%".$nik."%")
        ->where('npwp','LIKE',"%".$npwp."%")->count();
       
        if($validasi>0)
        {
            alert()->error('Gagal','Data Sudah Ditambahkan');
            return redirect()->route('karyawan.table')->with('fail','Data sudah terdaftar');}
       
        else{
            $validated = $request->validate([
                'f_nik' =>'mimes:jpg,bmp,png',
                'f_npwp' =>'mimes:jpg,bmp,png',
                'f_tabungan' =>'mimes:jpg,bmp,png',
            ]);
        $employe = new employe;
        $employe->nik=$request->nik;
        $employe->npwp=$request->npwp;
        $employe->nama=$request->nama;
        $employe-> tempat=$request->tempat;
        $employe->tanggal=$request->lahir;
        $employe->kelamin=$request->kelamin;
        $employe->telp=$request->telp;
        $employe->email=$request->email;
        $employe->alamat=$request->alamat;
        $employe->bank=$request->bank;
        $employe->norek=$request->norek;
        
        $foto1 = $request->f_nik;
        $namafile1 = time().'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $request->f_nik->storeAs('thumbnail',$namafile1);//memindahkan data ke public
        $foto1->move('images/ktp',$namafile1); //memindahkan gambar ke directory pribadi
        $employe->f_nik = $namafile1; //menyimpan ke data base
        
        $foto2 = $request->f_npwp;
        $namafile2 = time().'.'.$foto2->getClientOriginalExtension(); //pembuatan nama file
        $request->f_npwp->storeAs('thumbnail',$namafile2);//memindahkan data ke public
        $foto2->move('images/npwp',$namafile2); //memindahkan gambar ke directory pribadi
        $employe->f_npwp = $namafile2; //menyimpan ke data base
        
        $foto3 = $request->f_tabungan;       
        $namafile3 = time().'.'.$foto3->getClientOriginalExtension(); //pembuatan nama file
        $request->f_tabungan->storeAs('thumbnail',$namafile3);//memindahkan data ke public
        $foto3->move('images/tabungan',$namafile3); //memindahkan gambar ke directory pribadi
        $employe->f_tabungan = $namafile3; //menyimpan ke data base

        $employe->jabatan=$request->jabatan;
        $employe->akses="Pending";
        $employe->save();
        alert()->success('Success','Data Berhasil Ditambahkan');
        return redirect()->route('karyawan.table')->with('success','Data Berhasil Ditambahkan');
        
        }
    }

    public function ubah($id,$status)
    {   
        if($status == 'Approved')
        {
            $cari = employe::where('email',$id)->get();
            // dd($cari,$id);
            $nama='';
            $email='';
            $password='';
            $level='';
            foreach($cari as $cr)
            {
                $nama=$cr->nama;
                $email=$cr->email;
                $password=$cr->nik;
                $level=$cr->jabatan;
            }
            $smpn = new user;
            $smpn->name = $nama;
            $smpn->email = $email;
            $smpn->password = bcrypt($password);
            $smpn->level = $level;
            // dd($smpn);

            $smpn->save();
            $data2= employe::where('email',$id)->update(['akses'=>$status]);
        }
        else
        {
            // dd($id);
            $pcari = employe::where('email',$id)->first();
            if($pcari != null){
                $data2= employe::where('email',$id)->update(['akses'=>$status]);
                $data = user::where('email',$pcari->email)->delete();
            }
        }
        
        alert()->success('Success','Data Berhasil Di Ubah Menjadi '.$status);
        return redirect()->route('karyawan.table');
    }
    public function editing(request $request)
    {
        // dd($request->all());
        if($request->hasFile('f_nik') && $request->hasFile('f_npwp') && $request->hasFile('f_tabungan'))
        {
        $foto1 = $request->f_nik;
        $namafile1 = time().'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $request->f_nik->storeAs('thumbnail',$namafile1);//memindahkan data ke public
        $foto1->move('images/ktp',$namafile1); //memindahkan gambar ke directory pribadi
        $update['f_nik'] = $namafile1; //menyimpan ke data base
        
        $foto2 = $request->f_npwp;
        $namafile2 = time().'.'.$foto2->getClientOriginalExtension(); //pembuatan nama file
        $request->f_npwp->storeAs('thumbnail',$namafile2);//memindahkan data ke public
        $foto2->move('images/npwp',$namafile2); //memindahkan gambar ke directory pribadi
        $update['f_npwp'] = $namafile2; //menyimpan ke data base
        
        $foto3 = $request->f_tabungan;       
        $namafile3 = time().'.'.$foto3->getClientOriginalExtension(); //pembuatan nama file
        $request->f_tabungan->storeAs('thumbnail',$namafile3);//memindahkan data ke public
        $foto3->move('images/tabungan',$namafile3); //memindahkan gambar ke directory pribadi
        $update['f_tabungan'] = $namafile3; //menyimpan ke data base



            $update['nik'] =$request->nik;
            $update['npwp']=$request->npwp;
            $update['nama']=$request->nama;
            $update['tempat']=$request->tempat;
            $update['tanggal']=$request->lahir;
            $update['kelamin']=$request->kelamin;
            $update['telp']=$request->telp;
            $update['email']=$request->email;
            $update['alamat']=$request->alamat;
            $update['bank']=$request->bank;
            $update['norek']=$request->norek;
            $update['jabatan']=$request->jabatan;
            $update['akses']="Pending";
        }
        elseif ($request->hasFile('f_nik')){
            $foto1 = $request->f_nik;
            $namafile1 = time().'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
            $request->f_nik->storeAs('thumbnail',$namafile1);//memindahkan data ke public
            $foto1->move('images/ktp',$namafile1); //memindahkan gambar ke directory pribadi
            $update['f_nik'] = $namafile1; //menyimpan ke data base

            $update['nik'] =$request->nik;
            $update['npwp']=$request->npwp;
            $update['nama']=$request->nama;
            $update['tempat']=$request->tempat;
            $update['tanggal']=$request->lahir;
            $update['kelamin']=$request->kelamin;
            $update['telp']=$request->telp;
            $update['email']=$request->email;
            $update['alamat']=$request->alamat;
            $update['bank']=$request->bank;
            $update['norek']=$request->norek;
            $update['jabatan']=$request->jabatan;
            $update['akses']="Pending";
        }
        elseif ($request->hasFile('f_npwp')) {
            $foto2 = $request->f_npwp;
            $namafile2 = time().'.'.$foto2->getClientOriginalExtension(); //pembuatan nama file
            $request->f_npwp->storeAs('thumbnail',$namafile2);//memindahkan data ke public
            $foto2->move('images/npwp',$namafile2); //memindahkan gambar ke directory pribadi
            $update['f_npwp'] = $namafile2; //menyimpan ke data base
            
            $update['nik'] =$request->nik;
            $update['npwp']=$request->npwp;
            $update['nama']=$request->nama;
            $update['tempat']=$request->tempat;
            $update['tanggal']=$request->lahir;
            $update['kelamin']=$request->kelamin;
            $update['telp']=$request->telp;
            $update['email']=$request->email;
            $update['alamat']=$request->alamat;
            $update['bank']=$request->bank;
            $update['norek']=$request->norek;
            $update['jabatan']=$request->jabatan;
            $update['akses']="Pending";
        }
        elseif ($request->hasFile('f_tabungan')) {
            $foto3 = $request->f_tabungan;       
            $namafile3 = time().'.'.$foto3->getClientOriginalExtension(); //pembuatan nama file
            $request->f_tabungan->storeAs('thumbnail',$namafile3);//memindahkan data ke public
            $foto3->move('images/tabungan',$namafile3); //memindahkan gambar ke directory pribadi
            $update['f_tabungan'] = $namafile3; //menyimpan ke data base
        
            $update['nik'] =$request->nik;
            $update['npwp']=$request->npwp;
            $update['nama']=$request->nama;
            $update['tempat']=$request->tempat;
            $update['tanggal']=$request->lahir;
            $update['kelamin']=$request->kelamin;
            $update['telp']=$request->telp;
            $update['email']=$request->email;
            $update['alamat']=$request->alamat;
            $update['bank']=$request->bank;
            $update['norek']=$request->norek;
            $update['jabatan']=$request->jabatan;
            $update['akses']="Pending";
        }
        else{
        $update['nik'] =$request->nik;
        $update['npwp']=$request->npwp;
        $update['nama']=$request->nama;
        $update['tempat']=$request->tempat;
        $update['tanggal']=$request->lahir;
        $update['kelamin']=$request->kelamin;
        $update['telp']=$request->telp;
        $update['email']=$request->email;
        $update['alamat']=$request->alamat;
        $update['bank']=$request->bank;
        $update['norek']=$request->norek;
        $update['jabatan']=$request->jabatan;
        $update['akses']="Pending";
        }
        $data = employe::where('id',$request->id)->update($update);
        alert()->success('Success','Data Berhasil Diupdate');
        return redirect()->route('karyawan.table');

    }
    public function hapus($id)
    {
        $data = user::where('email',$id)->delete();
        $kar = employe::where('email',$id)->delete();
        alert()->success('Success','Karyawan Berhasil Dihapus');
        return redirect()->route('karyawan.table');
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
