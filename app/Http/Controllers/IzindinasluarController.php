<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IzindinasluarController extends Controller
{
    public function create()
    {
        $masterdinasluar = DB::table('master_dinasluar')->orderBy('kode_dinasluar')->get();
        return view('izindinasluar.create', compact('masterdinasluar'));
    }
    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $kode_dinasluar = $request->kode_dinasluar;
        $status = "d";
        $keterangan = $request->keterangan;

        $bulan = date("m", strtotime($tgl_izin_dari));
        $tahun = date("Y", strtotime($tgl_izin_dari));
        $thn = substr($tahun, 2, 2);

        $lastizin = DB::table('pengajuan_izin')
            ->whereRaw('MONTH(tgl_izin_dari)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_izin_dari)="' . $tahun . '"')
            ->orderBy('kode_izin', 'desc')
            ->first();

        $lastkodeizin = $lastizin != null ? $lastizin->kode_izin : "";
        $format = "IZ" . $bulan . $thn;
        $kode_izin = buatkode($lastkodeizin, $format, 3);

        //hitung jumlah dinas luar yg diajukan
        $jmldinasluar = hitunghari($tgl_izin_dari, $tgl_izin_sampai);

        //cek jumlah maksimal dinasluar
        $dinasluar = DB::table('master_dinasluar')->where('kode_dinasluar', $kode_dinasluar)->first();
        $jmlmaxdinasluar = $dinasluar->jml_dinasluar;

        //cek jumlah dinasluar yg sudah digunakan pada bulan aktif
        $dinasluardigunakan = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->where('status', 'd')
            ->where('nik', $nik)
            ->count();

        //sisa dinasluar
        $sisadinasluar = $jmlmaxdinasluar - $dinasluardigunakan;

        //cek kode izin
        $data = [
            'kode_izin' => $kode_izin,
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'kode_dinasluar' => $kode_dinasluar,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        //cek sudah absen/belum
        $cekpresensi = DB::table('presensi')
            ->whereBetween('tgl_presensi', [$tgl_izin_dari, $tgl_izin_sampai])
            ->where('nik', $nik);

        //cek sudah diajukan/belum
        $cekpengajuan = DB::table('pengajuan_izin')
            ->where('nik', $nik)
            ->whereRaw('"' . $tgl_izin_dari . '" BETWEEN tgl_izin_dari AND tgl_izin_sampai');

        $datapresensi = $cekpresensi->get();

        if ($jmldinasluar > $sisadinasluar) {
            return redirect('/presensi/izin')->with(['error' => 'Jumlah dinas luar melebihi batas maksimal 
            jatah dinas luar dalam satu bulan, sisa dinas luar anda adalah ' . $sisadinasluar . ' hari']);
        } else if ($cekpresensi->count() > 0) {
            $blacklistdate = "";
            foreach ($datapresensi as $d) {
                $blacklistdate .= date('d-m-Y', strtotime($d->tgl_presensi)) . ",";
            }
            return redirect('/presensi/izin')->with(['error' => 'Tidak bisa melakukan pengajuan pada tanggal ' . $blacklistdate . ' karena tanggal telah digunakan, silahkan ganti periode pengajuan']);
        } else if ($cekpengajuan->count() > 0) {
            return redirect('/presensi/izin')->with(['error' => 'Tidak bisa melakukan pengajuan pada tanggal tersebutkarena tanggal telah digunakan sebelumnya!']);
        } else {
            $simpan = DB::table('pengajuan_izin')->insert($data);
            if ($simpan) {
                return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
            }
        }
    }
    public function edit($kode_izin)
    {
        $dataizin = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->first();
        $masterdinasluar = DB::table('master_dinasluar')->orderBy('kode_dinasluar')->get();
        return view('izindinasluar.edit', compact('masterdinasluar', 'dataizin'));
    }
    public function update($kode_izin, Request $request)
    {
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $keterangan = $request->keterangan;
        $kode_dinasluar = $request->kode_dinasluar;

        try {
            //code...
            $data = [
                'tgl_izin_dari' => $tgl_izin_dari,
                'tgl_izin_sampai' => $tgl_izin_sampai,
                'kode_dinasluar' => $kode_dinasluar,
                'keterangan' => $keterangan
            ];
            DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->update($data);
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Diupdate']);
        }
    }
    public function getmaxdinasluar(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $kode_dinasluar = $request->kode_dinasluar;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $bulan_dinasluar = date('m', $tgl_izin_dari);
        $dinasluar = DB::table('master_dinasluar')->where('kode_dinasluar', $kode_dinasluar)->first();

        if ($kode_dinasluar == "D01") {
            $dinasluar_digunakan = DB::table('presensi')
                ->join('pengajuan_izin', 'presensi.kode_izin', '=', 'pengajuan_izin.kode_izin')
                ->where('presensi.status', 'd')
                ->where('kode_dinasluar', 'D01')
                ->whereRaw('MONTH(tgl_presensi)="' . $bulan_dinasluar . '"')
                ->where('presensi.nik', $nik)
                ->count();
            $max_dinasluar = $dinasluar->jml_dinasluar - $dinasluar_digunakan;
        } else {
            $max_dinasluar = $dinasluar->jml_dinasluar;
        }
        return $max_dinasluar;
    }
}
