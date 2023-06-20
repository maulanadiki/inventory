<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detailprocurment;
use App\Models\procurment;
use App\Models\selldetail;
use App\Models\selling;
use App\Models\Goods;
use App\Models\employe;
use Illuminate\Support\Facades\DB;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_label = array();
        $barang =Goods::get();
        $data_msk = array();
        $data_masuk = array();
        $data_barang = array();
        $nilai = array( );
        $nilai2 = array( );
        $nilai3 = array( );


        $data_kel = array();
        $data_keluar = array();

        $data_stkgd =array();
        $data_stk = array();
        $employe = employe::get();
        foreach($barang as $brg)
        {
            $data_label[] = $brg->kode_barang;
        }
        $data_barangmasuk = DB::table('detailprocurment')->leftJoin('procurment','procurment.nopo','=','detailprocurment.no_po')->leftJoin('pr','pr.nopo','detailprocurment.no_po')->where('status_bayar','=','Done')
        ->where('statpr','=','Recieved')->get();
        $data_barangkeluar = DB::table('selldetail')->leftJoin('sell','sell.invoice','=','selldetail.invoice')
        ->where('stat_keluar','=','Approved')->get();

        $data_stokbrg = DB::table('stockgood')->get();
        
        $data_beli = procurment::leftJoin('vendor','vendor.kode_vendor','=','procurment.Kode_vendor')->get();
        $data_jual = selling::get();
        // dd($data_beli, $data_jual);


        foreach($barang as $brg)
        {
            foreach($data_barangmasuk as $data_brg)
            {
                // dd($nilai[] = $brg->kode_barang);
                $nilai = array($data_brg->qty);

                if($data_brg->kode_barang == $brg->kode_barang)
                {
                    $data_msk[$brg->kode_barang][] = array_sum($nilai);
                }
                else{
                    $data_msk[$brg->kode_barang][] = 0;
                }
            }
            // dd($data_msk);
            if($data_msk != null )
            {
                $data_masuk[] = array_sum($data_msk[$brg->kode_barang]); 
            }
            else {
                $data_masuk[] = 0; 
            }
              
           
            foreach ($data_barangkeluar as $data_klr) 
            {
                if($data_klr->kode_barang == $brg->kode_barang)
                {
                    $nilai2[] = $data_klr->qty;
                $data_kel[$brg->kode_barang][] = array_sum($nilai2);
                }
                else {
                $data_kel[$brg->kode_barang][] = 0;
                }
            }
            $data_keluar[] = array_sum($data_kel[$brg->kode_barang]);

                
            
            


            foreach($data_stokbrg as $dt_stk)
            {
                if($dt_stk->kode_barang == $brg->kode_barang)
               {
                $data_stkgd[$brg->kode_barang][] = $dt_stk->kuantitas;
               }
               else {
                $data_stkgd[$brg->kode_barang][] = 0;
               }
            }
            $data_stk[] = array_sum($data_stkgd[$brg->kode_barang]);
        }
        return view('8report.table', compact('data_label','employe','data_masuk','data_keluar','data_stk','data_beli','data_jual') );
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
