<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\employe;
use Illuminate\Support\Str;
use App\Models\procurment;
use App\Models\Goods;
use App\Models\vendor;
use App\Models\detailprocurment;
use App\Models\stock;
use App\Models\selling;
use App\Models\selldetail;
use App\Models\barang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class Defashoes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $bln = date('m');

            // dd($bln);
            $yer = date('y');
            $number = cal_days_in_month(CAL_GREGORIAN, $bln, $yer); // 31
            $data_label =array();
            $data_pembelian_barang=array();
            $data_penjualan_barang=array();
            $data_beli =array();
            $data_pnjl =array();
            $data_jual = array();

            // keluar pie
            // dd($number);
            if ($number ==31)
            {
                $data_label = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20',
                '21','22','23','24','25','26','27','28','29','30','31');
            }
            else if($number==30)
            {
                $data_label = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20',
                '21','22','23','24','25','26','27','28','29','30');
            }
            else if($number ==28)
            {
                
                $data_label = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20',
                '21','22','23','24','25','26','27','28');
            }
            else
            {
                $data_label = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20',
                '21','22','23','24','25','26','27','28','29');
            }
            // dd($data_label);

            // $pembelian = detailprocurment::whereMonth('created_at','=',\Carbon\Carbon::now()->month )->get();
            $pembelian = detailprocurment::join('procurment','procurment.nopo','=','detailprocurment.no_po')->where('status_pengajuan','=','Approved')->whereMonth('detailprocurment.created_at','=',\Carbon\Carbon::now()->month )->get();
            // $penjualan = selldetail::whereMonth('created_at','=',Carbon::now()->month)->get();
            $penjualan = selldetail::join('sell','sell.invoice','=','selldetail.invoice')->where('sell.stat_keluar','=','Approved')->whereMonth('selldetail.created_at','=',Carbon::now()->month)->get();
            // $penjualan = selldetail::join('sell','sell.invoice','=','selldetail.invoice')->whereMonth('sell.created_at','=',Carbon::now()->month)
            // ->where('stat_keluar','=','Approved') ->get();
            // dd($penjualan);
            $keluar = selldetail::select('selldetail.kode_barang',DB::raw('SUM(qty) as qtykel'))
            ->leftJoin('sell','sell.invoice','=','selldetail.invoice')->where('stat_keluar','=','Approved')
            ->groupBy('kode_barang')->get();
            $minta = selldetail::select('selldetail.kode_barang',DB::raw('SUM(qty) as mtkel'))
            ->leftJoin('sell','sell.invoice','=','selldetail.invoice')->where('stat_keluar','=','Approved')
            ->groupBy('kode_barang')->get();
            $brgs = selldetail::count();
            $barangss = barang::leftJoin('stockgood','stockgood.kode_barang','=','barang.kode_barang')->get();
            // parameter
            $barang_keluar = [];
            $brg_kel = [];
            $rata =[];
            $EOQ = [];
            
            
           

            foreach ($keluar as $kel) {
                $rata[] = $kel->qtykel;
            }
            $permintaan = array_sum($rata);
            // dd($brgs);
            $rata_rata =null;
            if($brgs == 0 )
            {
                $rata_rata = 0;
            }
            else {
                $rata_rata = array_sum($rata) / $brgs;
            }
            
            


            // dd($brg_kel,$permintaan ,$rata_rata);
            for($i=0;$i<count($brg_kel);$i++)
            {
                $EOQ[] = sqrt(2*$brg_kelel[$i]*$rata_rata);
                // dd($brg_kel*$rata_rata);
            }
            // dd($EOQ) economic order quantity;
           
            // rumus mencari selisih
            $minimal = ceil(sqrt(2*$permintaan*$rata_rata));
            // dd($minimal);
            $selisih = [];
            $selisih_barang = [];
            foreach ($barangss as $kl) {
                foreach($minta as $mt){
                    if($kl->kode_barang == $mt->kode_barang){
                        $selisih = $kl->kuantitas - $mt->kel - $minimal;
                        if($selisih == null || $selisih == ''){
                            $selisih_barang = 0;
                        }
                        else{
                            $selisih_barang="error kode";
                        }
                    }
                }
            }
            // dd($selisih_barang);


            if($pembelian->isEmpty() )
            {
                $data_beli[1]=0;
            }
            else {
                foreach($data_label as $key =>$bln){
                    foreach($pembelian as $pembelians){
                        if($pembelians->created_at->format('d') == $bln){
                            $data_pembelian_barang[$bln][] = array_sum(explode(',',$pembelians->qty));
                        }else{
                            $data_pembelian_barang[$bln][] = 0;
                        }
                    }
                    $data_beli[] = array_sum($data_pembelian_barang[$bln]);
                }
            }
            

            if($penjualan->isEmpty())
            {
                $data_jual[1]=0;
            }
            else{
                foreach($data_label as $key =>$bln){
                    foreach($penjualan as $penjualans)
                    {
                        if($penjualans->created_at->format('d') == $bln){
                            $data_penjualan_barang[$bln][] = array_sum(explode(',',$penjualans->qty));
                        }
                        else{
                            $data_penjualan_barang[$bln][] = 0;
                        }
                    }
                    $data_jual[] = array_sum($data_penjualan_barang[$bln]);
                }
            }
            // dd($data_penjualan_barang[26]);

        


        $pembelian = DB::table('procurment')->where('status_pengajuan','=','Pending')->count();
        $penjualan= DB::table('sell')->where('stat_keluar','=','Pending')->count();
        // $terima_barang = DB::table('pr')->where('statpo','!=','Rejected')->where('statpr','=','pending')->count();
        $terima_barang = procurment::leftJoin('detailprocurment','detailprocurment.no_po','=','procurment.nopo')->leftJoin('pr','pr.nopo','=','procurment.nopo')->where('bukti_bayar','!=','Pending')->where('bukti','=','None')->count();
        $employe = DB::table('employe')->count();

        $penerima = DB::table('pr')->where('statpay','=','Done')->where('statpr','=','pending')->count('nopo');
        $sell =DB::table('sell')->count('invoice');
        // dd($pembelianp);
       $vendor = DB::table('vendor')->count('kode_vendor');
       $kuantitas = DB::table('stockgood')->sum('kuantitas');
       $barang = DB::table('barang')->count('kode_barang');
       $user = DB::table('users')->count('email');

       $beli = DB::table('procurment')->orderBy('created_at','desc')->paginate(10);
       $terima =DB::table('pr')->orderBy('created_at','desc')->paginate(10);
       $jual = DB::table('sell')->orderBy('created_at','desc')->paginate(10);
       $setTask_todo = $pembelian + $penerima + $penjualan;
        $task_todo = session()->put('task_todo',$setTask_todo);
        $task_pembelian = session()->put('task_beli',$pembelian);
        $task_penjualan=session()->put('task_jual',$penjualan);
        $task_terima=session()->put('task_terima',$penerima);
        // dd($penerima);

       
        return view ('1dashboard.content',compact('penerima','selisih_barang','employe','terima_barang','penjualan','minta','rata_rata','barangss','brgs','EOQ','brg_kel','keluar','data_beli','data_jual','data_label','pembelian','penerima','sell','vendor','barang','user','kuantitas'),['beli'=>$beli, 'terima'=>$terima,'jual'=>$jual] );
       
    }

    public function login()
    {
        return view('0login.login2');
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
    //     $request->validate([
    //         'email'=>'required|email|exists:users,email',
    //         'password'=> 'required|max:30'
    //     ],['email.exists'=>'this email doesnt exists on database']
    // );
    $creds = $request->only(['email','password']);
    // dd($creds);
    
    if(Auth::attempt($creds) ){
        // $data = db::table('employe')->where('id','LIKE',"%".$request->email."%")->first();
        // dd($creds);
        $request->session()->regenerate();
        return redirect()->intended('/home');

    }else{
        return redirect()->route('login')->with('fail','Email And Password incorrect');
    }
    }

    public function logout(request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function changepw(request $request){
        // dd($request->all());
        $saat = Carbon::now();
        $password = Hash::make($request->password);
        // dd($password);
        $data = User::where('email','=',$request->email)->update(['password'=>$password,'updated_at'=>$saat]);
        alert()->success('Success','Password berhasil di update');
        return back()->with('success','Password berhasil di ubah');
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