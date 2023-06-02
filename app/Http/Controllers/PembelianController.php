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

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $procurment = procurment::get();
        $vendor = vendor::get();
        $data = detailprocurment::leftJoin('barang','barang.kode_barang','=','detailprocurment.kode_barang')->get();
        $procurment=DB::table('procurment')->orderByDesc('nopo')->leftJoin('vendor','procurment.Kode_vendor','=','vendor.kode_vendor')->get();
        // dd($procurment);
        return view('2pembelian.table',compact('data','procurment','vendor'));
    }
    public function Formbuat(){
        $barang = DB::table('barang')->get();
        $vendor = vendor::all();
        $stok = stock::all();
        $tls="PO.";
        $hari = $tls.date('dmy');
        $po = procurment::where('nopo','LIKE','%'.$hari.'%')->get();
        $po2 = $po->max();
        $lengkap= str::substr($po2,25,4);
        // dd($lengkap);

        
       
        
        if(empty($lengkap) )
        {
            $notrans=$hari."0001";
        }
        else
        {
            $idd = str_replace($hari, "", $lengkap);
            $id = str_pad($idd + 1, 4, 0, STR_PAD_LEFT);
            // $id = str_pad($idd,1,0);
            // dd($id);
            
            $notrans = $hari.$id;
            // $no = str::substr($po);
        }
        // dd($notrans);
        
        $pembelian = procurment::count();


        return view('2pembelian.buat',compact('barang','vendor','stok','notrans','pembelian'));
    }

    public function simpanbeli(request $request){
        $data=$request->all();
        // dd($data);
        
        $validated = $request->validate([
        'vcode'=>'required',
        'vbank'=>'required',
        'norek'=>'required',
        'kode'=>'required'
        ]);
        $a = $request->beli;
        // dd($a);
        if(count(array($data['kode']>0 ))){
            foreach($data['kode'] as $isi =>$value)
            {
                $data2=array(
                    'no_po'=>$request->nopo,
                    'kode_barang'=>$data['kode'][$isi],
                    'harga_beli'=>$data['beli'][$isi],
                    'qty'=>$data['qty'][$isi],    
                    'subtotal'=>$data['beli'][$isi] * $data['qty'][$isi],
                    'create_at'=>date('dmY')
                );
                detailprocurment::create($data2);
            }
        }
    $a = $request->nopo;
    $grandtotal = DB::table('detailprocurment')->where('no_po','LIKE','%'.$a.'%')->sum('subtotal');  
    $po = new procurment;
    $po->nopo = $request->nopo;
    $po->Kode_vendor = $request->kode_vendor;
    $po->grandtotal = $grandtotal;
    $po->status_pengajuan = 'Pending';
    $po->status_bayar = 'Pending';
    $po->bukti_bayar = 'Pending';
    $po->dibuat = date('Ymd');
    $po->email = auth()->user()->email;
    $po->save();
    
    $pr = new pr;
    $pr->kode_vendor = $request->kode_vendor;
    $pr->nopo =$request->nopo;
    $pr-> statpo = "Pending";
    $pr->statpay = "Pending";
    $pr-> statpr = "pending";
    $pr-> bukti = "None";
    $pr-> created_at = date("Ymd");
    $pr->updated_at= date("Ymd");
    $pr->save();
    alert()->success('Success','Data Pembelian Berhasil Ditambahkan');
    return redirect()->route('pembelian');
    // $data=DB::table('procurment')->orderByDesc('nopo')->leftJoin('vendor','procurment.Kode_vendor','=','vendor.kode_vendor')->paginate(10); 
    // return redirect()->route('pembelian.buat')->with('success', 'Data PO Berhasil Di Tambahkan');
    }

    public function carivendor(request $request){
        if($request->ajax())
        {
            $vendor =DB::table('vendor')->where('kode_vendor','LIKE','%'.$request->vnd.'%')->get();
            return response()->json(['data'=>$vendor]);
        }


    }
    public function cari(request $request)
    {
        if($request->ajax())
        {
            $nilai = [$request->cari];
            $data = DB::table('barang')->whereIn('kode_barang',$nilai)->get();

            // dd($data);   
            return response()->json(['data'=>$data]);
            
        }
    }

    public function status_pengajuan($id, $status)
    {
        // dd($status);
        $data = procurment::where('nopo','=',$id)->update(['status_pengajuan'=>$status]);
        $pr = pr::where('nopo','=',$id)->update(['statpo'=>$status]);
        alert()->success('Success','Data Pembelian Berhasil Ditambahkan');
        return redirect()->route('pembelian');
    }

    public function status_pembayaran (request $request)
    {
        $foto1 = $request->gambar;
        $bbyar = rand(11111, 99999).'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $request->gambar->storeAs('thumbnail',$bbyar);//memindahkan data ke public
        $foto1->move('images/',$bbyar); //memindahkan gambar ke directory pribadi
        $update = procurment::where('nopo',$request->id)->update(['status_bayar'=>'Done','bukti_bayar'=>$bbyar,'updated_at'=>date('Y-m-d h:i:s')]);

        $upr = pr::where('nopo',$request->id)->update(['statpay'=>'Done']);
        alert()->success('Success','Bukti Pembayaran berhasil di Upload');
        return redirect()->route('pembelian');
    }

    public function detailbeli(request $request)
    {
        if($request->ajax())
        {
            $nomor=1;
           
            $data = DB::table('procurment')->where('nopo','LIKE','%'.$request->search.'%')->leftJoin('detailprocurment','procurment.nopo','=','detailprocurment.no_po')->leftJoin('barang','detailprocurment.kode_barang','=','barang.kode_barang')->get();
            return response()->json(['data'=>$data]);
            
        }
    }

    public function terima_table()
    {
        $hasil=db::table('pr')->rightJoin('vendor','pr.Kode_vendor','=','vendor.kode_vendor')->rightJoin('procurment','pr.nopo','=','procurment.nopo')->rightJoin('detailprocurment','pr.nopo','=','detailprocurment.no_po')->get();
            $group = db::table('pr')->rightJoin('vendor','pr.Kode_vendor','=','vendor.kode_vendor')->rightJoin('procurment','pr.nopo','=','procurment.nopo')->get();
        
        
        return view('2pembelian.terima.table_pr',compact('hasil','group'));
    }

    public function form_penerima_barang($id)
    {
       
        $data=detailprocurment::where('no_po','LIKE','%'.$id.'%')->rightJoin('procurment','detailprocurment.no_po','=','procurment.nopo')->rightJoin('vendor','procurment.Kode_vendor','=','vendor.kode_vendor')->rightJoin('barang','detailprocurment.kode_barang','=','barang.kode_barang')->get();
        $cek = detailprocurment::where('no_po','LIKE','%'.$id.'%')->rightJoin('procurment','detailprocurment.no_po','=','procurment.nopo')->rightJoin('vendor','procurment.Kode_vendor','=','vendor.kode_vendor')->first();
        $brg = detailprocurment::where('no_po','LIKE','%'.$id.'%')->rightJoin('procurment','detailprocurment.no_po','=','procurment.nopo')->get();        
        $st = detailprocurment::where('no_po','LIKE','%'.$id.'%') ->rightJoin('stockgood','detailprocurment.kode_barang','=','stockgood.kode_barang')->get();
        
        
        return view('2pembelian.terima.form_ttd',compact('cek'),['data'=>$data,'brg'=>$brg,'st'=>$st]);
    }

    public function pprc(request $request ,$nopo)
    {
        // dd($request->all());
        $data=$request->kobar;
        $isi = $request->qty;
        for ($i=0; $i < count($data) ; $i++) { 
            stock::where(['kode_barang'=>$data[$i] ]) -> update(['kuantitas' => $isi[$i]]);
        }

        $foto1 = $request->foto;
        $bbyar = rand(11111, 99999).'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $request->foto->storeAs('thumbnail',$bbyar);//memindahkan data ke public
        $foto1->move('images/',$bbyar); //memindahkan gambar ke directory pribadi
        $update = pr::where('nopo',$nopo)->update(['statpr'=>'Recieved','bukti'=>$bbyar]);
        $dt =  DB::table('pr')->where('nopo','=', $nopo)->rightJoin('detailprocurment','pr.nopo','=','detailprocurment.no_po')->get();
        $hasil=db::table('pr')->rightJoin('vendor','pr.Kode_vendor','=','vendor.kode_vendor')
        ->rightJoin('procurment','pr.nopo','=','procurment.nopo')->rightJoin('detailprocurment','pr.nopo','=','detailprocurment.no_po')->get();
        $group = db::table('pr')->rightJoin('vendor','pr.Kode_vendor','=','vendor.kode_vendor')
        ->rightJoin('procurment','pr.nopo','=','procurment.nopo')->get();
        alert()->success('Success','Bukti Tanda Terima Barang Berhasil di Upload');
        return redirect()->route('barang.terimatable');
    }
    public function tandaterima($nopo)
    {
        $data=detailprocurment::where('no_po','LIKE','%'.$nopo.'%')->rightJoin('procurment','detailprocurment.no_po','=','procurment.nopo')->rightJoin('vendor','procurment.Kode_vendor','=','vendor.kode_vendor')->rightJoin('barang','detailprocurment.kode_barang','=','barang.kode_barang')->get();
        $cek = detailprocurment::where('no_po','LIKE','%'.$nopo.'%')->rightJoin('procurment','detailprocurment.no_po','=','procurment.nopo')->rightJoin('vendor','procurment.Kode_vendor','=','vendor.kode_vendor')->first();
        $beli = procurment::where('nopo','LIKE','%'.$nopo.'%')->first();
        $brg = detailprocurment::where('no_po','LIKE','%'.$nopo.'%')->rightJoin('procurment','detailprocurment.no_po','=','procurment.nopo')->get();        
        $st = detailprocurment::where('no_po','LIKE','%'.$nopo.'%') ->rightJoin('stockgood','detailprocurment.kode_barang','=','stockgood.kode_barang')->get();
        return view('2pembelian.terima.tandaterima',compact('cek','beli'),['data'=>$data,'brg'=>$brg,'st'=>$st]);
    }

    public function pembelian_hapus($id)
    {
        $detail = detailprocurment::where('no_po','=',$id)->delete();
        $po = procurment::where('nopo','=',$id)->delete();
        alert()->success('Success','PO Barang Berhasil Di Hapus');
        return redirect()->route('pembelian');
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
