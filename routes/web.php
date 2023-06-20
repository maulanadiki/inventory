<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Defashoes;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\taskController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\KaryawanControlle;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [Defashoes::class, 'login'])->name('login');
Route::post('/authenticate', [Defashoes::class, 'authenticate'])->name('authenticate');
Route::get('/home', [Defashoes::class, 'index'])->name('home');
Route::get('/logout', [Defashoes::class, 'logout'])->name('logout');
Route::post('/changepw', [Defashoes::class, 'changepw'])->name('changepw');

Route::get('/task_todo', [taskController::class, 'index'])->name('task_todo');
Route::post('/task/pembelian/bayar',[taskController::class,'update_status_pembayaran'])->name('task.barang');
Route::get('task/status/{id}/{status}',[taskController::class,'update_status_pengajuan'])->name('task_status');
Route::get('task/barang_keluar/{status}/{id}',[taskController::class,'task_keluar'])->name('task.barang_keluar');

// pembelian
Route::get('/pembelian',[PembelianController::class,'index'])->name('pembelian');
Route::get('/pembelian/BuatPembelian',[PembelianController::class,'Formbuat'])->name('pembelian.buat');
Route::post('/pembelian/BuatPembelian/simpan',[PembelianController::class,'simpanbeli'])->name('savepo');
Route::get('/pembelian/BuatPembelian/simpan/carivendor',[PembelianController::class,'carivendor'])->name('carivendor');
Route::get('/pembelian/BuatPembelian/caribarang',[PembelianController::class,'cari'])->name('caribarang');
Route::get('/pembelian/status/{id}/{status}',[PembelianController::class,'status_pengajuan'])->name('barang.status');
Route::post('/pembelian/bayar',[PembelianController::class,'status_pembayaran'])->name('barang.bayar');
Route::get('/detailbeli',[PembelianController::class,'detailbeli'])->name('barang.detailbeli');
Route::get('/pembelian_hapus/{id}',[PembelianController::class,'pembelian_hapus'])->name('barang.pembelian.hapus');


// terima barang
Route::get('/penerimaan',[PembelianController::class,'terima_table'])->name('barang.terimatable');
Route::post('/penerima',[PembelianController::class,'penerima_barang'])->name('penerima');
Route::get('/penerima/terima/{id}',[PembelianController::class,'form_penerima_barang'])->name('penerima.terima');
Route::post('/penerima/terima/pprc/{nopo}',[PembelianController::class,'pprc'])->name('prrc');
Route::get('/penerima/terima/tandaterima/{nopo}',[PembelianController::class,'tandaterima'])->name('tandaterima');

// penjualan
Route::get('/penjualan',[PenjualanController::class,'index'])->name('penjualan');
Route::get('/penjualan/form',[PenjualanController::class,'form_penjualan'])->name('penjualan.buat');
Route::post('/penjualan/form/simpan',[PenjualanController::class,'simpan_penjualan'])->name('penjualan.simpan');
Route::get('/cselling',[PenjualanController::class,'cselling'])->name('penjualan.cselling');
Route::get('/penjualan/barang_keluar/{status}/{id}',[PenjualanController::class,'barang_keluar'])->name('penjualan.barang_keluar');
Route::get('/penjualan/barang_keluar/{id}',[PenjualanController::class,'barang_keluar_hapus'])->name('penjualan.barang_keluar.hapus');
Route::post('/penjualan/barang_keluar/simpan_resi',[PenjualanController::class,'simpan_resi'])->name('penjualan.simpan_resi');


route::get('/barang',[BarangController::class,'index'])->name('barang.tabel');
route::get('/barang/buat',[BarangController::class,'buat'])->name('barang.buat');
route::post('/barang/simpan',[BarangController::class,'simpan'])->name('barang.simpan');
route::get('/barang/stok',[BarangController::class,'stok'])->name('barang.stok');

// vendor
route::get('/vendors',[VendorController::class,'index'])->name('vendor.table');
route::get('/vendors/form',[VendorController::class,'buat'])->name('vendor.buat');
route::post('/vendors/form/save',[VendorController::class,'simpan'])->name('vendor.simpan');
route::get('/vendors/hapus/{id}',[VendorController::class,'destroy'])->name('vendor.hapus');

// karyawan
route::get('/karyawan',[KaryawanControlle::class,'index'])->name('karyawan.table');
route::post('/karyawan/simpan',[KaryawanControlle::class,'simpan'])->name('karyawan.simpan');
route::post('/karyawan/edit',[KaryawanControlle::class,'editing'])->name('karyawan.edit');
route::get('/karyawan/update/{id}/{status}',[KaryawanControlle::class,'ubah'])->name('karyawan.update');
route::get('/karyawan/akses',[KaryawanControlle::class,'akses'])->name('karyawan.akses');
route::get('/karyawan/hapus/{id}',[KaryawanControlle::class,'hapus'])->name('karyawan.hapus');

// report
route::get('/report',[ReportController::class,'index'])->name('report');

//report





