<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Validation\ValidationException;
use App\Models\employe;
use Illuminate\Support\Str;
use App\Models\procurment;
use App\Models\Goods;
use App\Models\vendor;
use App\Models\detailprocurment;
use App\Models\pr;
use App\Models\stock;
use App\Models\selling;
use App\Models\selldetail;
use App\Models\User;
use Carbon\Carbon;


class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request){
        $tanggalSekarang = date('Y-m-d');
        $pembelian = procurment::leftJoin('detailprocurment','detailprocurment.no_po','=','procurment.nopo')->leftJoin('barang','barang.kode_barang','=','detailprocurment.kode_barang')->where('status_pengajuan','=','Pending')->get();
        $penjualan = selling::leftJoin('selldetail','selldetail.invoice','=','sell.invoice')->leftJoin('barang','barang.kode_barang','=','selldetail.kode_barang')->where('stat_keluar','=','Pending')->get();
        $penerimaan = procurment::leftJoin('detailprocurment','detailprocurment.no_po','=','procurment.nopo')->leftJoin('pr','pr.nopo','=','procurment.nopo')->where('bukti_bayar','!=','Pending')->where('bukti','=','None')->get();
        $procurment= procurment::where('status_pengajuan','=','Pending')->get();
        $receive = pr::where('statpay','=','Done')->where('statpr','=','pending')->get();
        $sell = selling::where('stat_keluar','=','Pending')->get();
        $kobar = DB::table('selldetail')->leftJoin('sell','selldetail.invoice','=','sell.invoice')->leftJoin('barang','selldetail.kode_barang','=','barang.kode_barang')->leftJoin('stockgood','barang.kode_barang','=','stockgood.kode_barang')->get();
        $vendors = vendor::leftJoin('pr','pr.kode_vendor','=','vendor.kode_vendor')->leftJoin('detailprocurment','detailprocurment.no_po','=','pr.nopo')->
        leftJoin('barang','barang.kode_barang','detailprocurment.kode_barang')->leftJoin('procurment','procurment.nopo','=','pr.nopo')->get();
        // dd($vendors);


        return view('1dashboard.task_todo',compact('kobar','sell','procurment','pembelian','penerimaan','penjualan','receive','vendors') );
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


    public function update_status_pembayaran (request $request)
    {
        // dd($request->all());
        $foto1 = $request->gambar;
        $bbyar = rand(11111, 99999).'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $request->gambar->storeAs('thumbnail',$bbyar);//memindahkan data ke public
        $foto1->move('images/',$bbyar); //memindahkan gambar ke directory pribadi
        $update = procurment::where('nopo',$request->nopo)->update(['status_pengajuan'=>'Approved','status_bayar'=>'Done','bukti_bayar'=>$bbyar,'updated_at'=>date('Y-m-d h:i:s')]);

        $upr = pr::where('nopo',$request->nopo)->update(['statpay'=>'Done','updated_at'=>date('Y-m-d h:i:s')]);
        alert()->success('Success','Bukti Pembayaran berhasil di Upload');
        return redirect()->route('task_todo');
    }

    public function update_status_pengajuan($id, $status)
    {
        // dd($status);
        $data = procurment::where('nopo','=',$id)->update(['status_pengajuan'=>$status]);
        $pr = pr::where('nopo','=',$id)->update(['statpo'=>$status]);
        alert()->success('Success','Data Pembelian Berhasil Ditambahkan');
        return redirect()->route('task_todo');
    }

    public function task_keluar(request $request, $status,$invoice)
    {
        // dd("Data Barang Keluar Di - ".$status);
        $data=$request->kobar;
        $isi = $request->qty;
        if($status === "Approved")
        {
        for ($i=0; $i < count($data) ; $i++) { 
            stock::where(['kode_barang'=>$data[$i] ]) ->update(['kuantitas' => $isi[$i]]);
            $update = selling::where('invoice',$invoice)->update(['stat_keluar'=>$status,'updated_at'=>date("Y-m-d")]);
            // dd($isi, $data);
            }
            alert()->success("Data Barang Keluar Di - ".$status );
        }
        else {
            $update = selling::where('invoice',$invoice)->update(['stat_keluar'=>$status,'updated_at'=>date("Y-m-d")]);
            alert()->error("Data Barang Keluar Di - ".$status );
        }
       
        return redirect()->route('task_todo');

    }
}
