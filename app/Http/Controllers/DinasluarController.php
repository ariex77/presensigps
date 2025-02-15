<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;

class DinasluarController extends Controller
{
    public function index()
    {
        $dinasluar = DB::table('master_dinasluar')->orderBy('kode_dinasluar', 'asc')->get();
        return view('dinasluar.index', compact('dinasluar'));
    }
    public function store(Request $request)
    {
        $kode_dinasluar = $request->kode_dinasluar;
        $nama_dinasluar = $request->nama_dinasluar;
        $jml_dinasluar = $request->jml_dinasluar;

        $cekdinasluar = DB::table('master_dinasluar')->where('kode_dinasluar', $kode_dinasluar)->count();
        if ($cekdinasluar > 0) {
            return Redirect::back()->with(['warning' => 'Data kode dinas luar sudah ada']);
        }
        try {
            DB::table('master_dinasluar')->insert([
                'kode_dinasluar' => $kode_dinasluar,
                'nama_dinasluar' => $nama_dinasluar,
                'jml_dinasluar' => $jml_dinasluar
            ]);
            return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan' . $e->getMessage()]);
            //throw $th;
        }
    }
    public function edit(Request $request)
    {
        $kode_dinasluar = $request->kode_dinasluar;
        $dinasluar = DB::table('master_dinasluar')->where('kode_dinasluar', $kode_dinasluar)->first();
        return view('dinasluar.edit', compact('dinasluar'));
    }
    public function update(Request $request, $kode_dinasluar)
    {
        $nama_dinasluar = $request->nama_dinasluar;
        $jml_dinasluar = $request->jml_dinasluar;

        try {
            DB::table('master_dinasluar')->where('kode_dinasluar', $kode_dinasluar)
                ->update([
                    'nama_dinasluar' => $nama_dinasluar,
                    'jml_dinasluar' => $jml_dinasluar
                ]);
            return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate' . $e->getMessage()]);
            //throw $th;
        }
    }
    public function delete($kode_dinasluar)
    {
        try {
            DB::table('master_dinasluar')->where('kode_dinasluar', $kode_dinasluar)->delete();
            return Redirect::back()->with(['success' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal dihapus' . $e->getMessage()]);
        }
    }
}

