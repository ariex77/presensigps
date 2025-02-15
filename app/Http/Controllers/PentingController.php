<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;

class PentingController extends Controller
{
    public function index()
    {
        $izinpenting = DB::table('master_izin')->orderBy('kode_izinpenting', 'asc')->get();
        return view('izinpenting.index', compact('izinpenting'));
    }
    public function store(Request $request)
    {
        $kode_izinpenting = $request->kode_izinpenting;
        $nama_izinpenting = $request->nama_izinpenting;
        $jml_izinpenting = $request->jml_izinpenting;

        $cekizinpenting = DB::table('master_izin')->where('kode_izinpenting', $kode_izinpenting)->count();
        if ($cekizinpenting > 0) {
            return Redirect::back()->with(['warning' => 'Data kode izin alasan penting sudah ada']);
        }
        try {
            DB::table('master_izin')->insert([
                'kode_izinpenting' => $kode_izinpenting,
                'nama_izinpenting' => $nama_izinpenting,
                'jml_izinpenting' => $jml_izinpenting
            ]);
            return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan' . $e->getMessage()]);
            //throw $th;
        }
    }
    public function edit(Request $request)
    {
        $kode_izinpenting = $request->kode_izinpenting;
        $izinpenting = DB::table('master_izin')->where('kode_izinpenting', $kode_izinpenting)->first();
        return view('izinpenting.edit', compact('izinpenting'));
    }
    public function update(Request $request, $kode_izinpenting)
    {
        $nama_izinpenting = $request->nama_izinpenting;
        $jml_izinpenting = $request->jml_izinpenting;

        try {
            DB::table('master_izin')->where('kode_izinpenting', $kode_izinpenting)
                ->update([
                    'nama_izinpenting' => $nama_izinpenting,
                    'jml_izinpenting' => $jml_izinpenting
                ]);
            return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate' . $e->getMessage()]);
            //throw $th;
        }
    }
    public function delete($kode_izinpenting)
    {
        try {
            DB::table('master_izin')->where('kode_izinpenting', $kode_izinpenting)->delete();
            return Redirect::back()->with(['success' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal dihapus' . $e->getMessage()]);
        }
    }
}
