<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\procurment;
use App\Models\Goods;
use App\Models\vendor;
use App\Models\detailprocurment;
use App\Models\stock;
use App\Models\selling;
use App\Models\selldetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
Use Alert;
use Validator;
use File;
use Image;
use Auth;
use Session;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $csm = DB::table('sell')->get();    
        $kobar = DB::table('selldetail')->leftJoin('sell','selldetail.invoice','=','sell.invoice')
        ->leftJoin('barang','selldetail.kode_barang','=','barang.kode_barang')
        ->leftJoin('stockgood','barang.kode_barang','=','stockgood.kode_barang')->get();
        
        return view('3penjualan.table',compact('csm','kobar'));
    }
    public function form_penjualan()
    {
        $barang = DB::table('barang')->leftJoin('stockgood','barang.kode_barang','=','stockgood.kode_barang')->where('kuantitas','>',0)->get();
        $vendor = vendor::all();
        $stok = stock::all();

        $tls="INV";
        $hari = $tls.date('dmy');
        $po = selling::where('invoice','LIKE','%'.$hari.'%')->get();
        $po2 = $po->max();
        $lengkap= str::substr($po2,28,4);

        // dd($lengkap);
        if(empty($lengkap) )
        {
            $notrans=$hari."0001";
        }
        else
        {
            $idd = str_replace($hari, "", $lengkap);
            $id = str_pad($idd + 1, 4, 0, STR_PAD_LEFT);
            $notrans = $hari.$id;
            // $no = str::substr($po);
        }
    //    dd($notrans);
        
        // if($lengkap===$hari || $lengkap === 0 || $lengkap===false)
        // {
        //     $notrans = $hari."1";
        // }
        // else
        // {
        //     $carino = selling::where('invoice','like','%'.$lengkap.'%')->get();
            // dd($carino);
        //     $last =str::substr($po2,28,1);
        //     $next = $last+1;
        //     $notrans =$hari.$next;
            
        // }
        // dd($notrans);
        
        $pembelian = procurment::count();
        
        return view('3penjualan.buat',compact('barang','vendor','stok','notrans','pembelian'));
    }
    public function cselling(request $request){
        if($request->ajax())
        {
            $nomor=1;
           
        $data = DB::table('selldetail')->where('selldetail.invoice','LIKE','%'.$request->search .'%')->leftJoin('sell','selldetail.invoice','=','sell.invoice')->leftJoin('barang','selldetail.kode_barang','=','barang.kode_barang')->get();
        return response()->json(['data'=>$data]);
        }
            
        
    }
    public function simpan_penjualan(request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'kode'=>'required',
            'beli'=>'required',
            'jual'=>'required',
            'qty'=>'required'
            ]);
            
        $data=$request->all();
        $a = $request->kode;
        if(count(array($data['kode']>0 ))){
            foreach($data['kode'] as $isi =>$value)
            {
                $data2=array(
                    'invoice'=>$request->inv,
                    'kode_barang'=>$data['kode'][$isi],
                    'jual'=>$data['jual'][$isi],
                    'qty'=>$data['qty'][$isi],    
                    'subtotal'=>$data['jual'][$isi] * $data['qty'][$isi],
                    'create_at'=>date('dmY')
                );
                selldetail::create($data2);
            }
        }
        $grandtotal =selldetail::where('invoice','LIKE','%'.$request->inv.'%')->sum('subtotal');
        // dd($grandtotal);
        $sell = new selling;
        $sell->invoice =$request->inv;
        $sell->nama_pelanggan=$request->name;
        $sell->alamat_pelanggan = $request->alamat;
        $sell->telp=$request->telp;
        $sell->tgl_jual=$request->date;
        $sell->market_place=$request->market;
        $sell->grandtotal=$grandtotal;
        $sell->email= auth()->user()->email;
        $foto1 = $request->bukti;
        $bbyar = rand(11111, 99999).'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $request->bukti->storeAs('thumbnail',$bbyar);//memindahkan data ke public
        $foto1->move('images/',$bbyar); //memindahkan gambar ke directory pribadi
        $sell->bukti_pembelian = $bbyar;
        $sell->stat_keluar="Pending";
        $sell->stat_sell="Pending";
        $sell->bukti_resi="Pending";
        // $sell->created_at=date('Y-m-d');
        $sell->save();
        alert()->success('Success','Data Penjualan berhasil di input');
        return redirect('/penjualan');
    }

    public function barang_keluar(request $request, $status,$invoice)
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
       
        return redirect('/penjualan');

    }

    public function simpan_resi(request $request)
    {
        // dd($request->all());
        $foto1 = $request->resi;
        $bbyar = rand(11111, 99999).'.'.$foto1->getClientOriginalExtension(); //pembuatan nama file
        $foto1->storeAs('thumbnail',$bbyar);//memindahkan data ke public
        $foto1->move('images/',$bbyar); //memindahkan gambar ke directory pribadi
        selling::where('invoice','LIKE','%'.$request->id.'%')->update(['stat_sell'=>'Approved' ,'bukti_resi' => $bbyar]);
        alert()->success("Resi berhasil di upload");
        return redirect('/penjualan');
    }

    public function barang_keluar_hapus($id)
    {
        $sell = selling::where('invoice','=',$id)->delete();
        $selldetail = selldetail::where('invoice','=',$id)->delete();
        alert()->success("data berhasil di hapus");
        return redirect('/penjualan');
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
