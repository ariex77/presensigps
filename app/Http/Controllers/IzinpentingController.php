<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IzinpentingController extends Controller
{
    public function create()
    {
        $masterizinpenting = DB::table('master_izin')->orderBy('kode_izinpenting')->get();
        return view('izinalasanpenting.create', compact('masterizinpenting'));
    }
    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $kode_izinpenting = $request->kode_izinpenting;
        $status = "p";
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

        //hitung jumlah izin alasan penting yg diajukan
        $jmlizinpenting = hitunghari($tgl_izin_dari, $tgl_izin_sampai);

        //cek jumlah maksimal izin alasan penting
        $izinpenting = DB::table('master_izin')->where('kode_izinpenting', $kode_izinpenting)->first();
        $jmlmaxizinpenting = $izinpenting->jml_izinpenting;

        //cek jumlah izin alasan penting yg sudah digunakan pada bulan aktif
        $izinpentingdigunakan = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->where('status', 'p')
            ->where('nik', $nik)
            ->count();

        //sisa izin alasan penting
        $sisaizinpenting = $jmlmaxizinpenting - $izinpentingdigunakan;

        //cek kode izin
        $data = [
            'kode_izin' => $kode_izin,
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'kode_izinpenting' => $kode_izinpenting,
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

        if ($jmlizinpenting > $sisaizinpenting) {
            return redirect('/presensi/izin')->with(['error' => 'Jumlah izin alasan penting melebihi batas maksimal 
            jatah izin alasan penting dalam satu bulan, sisa izin alasan penting anda adalah ' . $sisaizinpenting . ' hari']);
        } else if ($cekpresensi->count() > 0) {
            $blacklistdate = "";
            foreach ($datapresensi as $d) {
                $blacklistdate .= date('d-m-Y', strtotime($d->tgl_presensi)) . ",";
            }
            return redirect('/presensi/izin')->with(['error' => 'Tidak bisa melakukan pengajuan pada tanggal ' . $blacklistdate . ' karena tanggal telah digunakan, silahkan ganti periode pengajuan']);
        } else if ($cekpengajuan->count() > 0) {
            return redirect('/presensi/izin')->with(['error' => 'Tidak bisa melakukan pengajuan pada tanggal tersebut karena tanggal telah digunakan sebelumnya!']);
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
        $masterizinpenting = DB::table('master_izin')->orderBy('kode_izinpenting')->get();
        return view('izinalasanpenting.edit', compact('masterizinpenting', 'dataizin'));
    }
    public function update($kode_izin, Request $request)
    {
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $keterangan = $request->keterangan;
        $kode_izinpenting = $request->kode_izinpenting;

        try {
            //code...
            $data = [
                'tgl_izin_dari' => $tgl_izin_dari,
                'tgl_izin_sampai' => $tgl_izin_sampai,
                'kode_izinpenting' => $kode_izinpenting,
                'keterangan' => $keterangan
            ];
            DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->update($data);
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Diupdate']);
        }
    }
    public function getmaxizinpenting(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $kode_izinpenting = $request->kode_izinpenting;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $bulan_izinpenting = date('m', $tgl_izin_dari);
        $izinpenting = DB::table('master_izin')->where('kode_izinpenting', $kode_izinpenting)->first();

        if ($kode_izinpenting == "P01") {
            $izinpenting_digunakan = DB::table('presensi')
                ->join('pengajuan_izin', 'presensi.kode_izin', '=', 'pengajuan_izin.kode_izin')
                ->where('presensi.status', 'p')
                ->where('kode_izinpenting', 'P01')
                ->whereRaw('MONTH(tgl_presensi)="' . $bulan_izinpenting . '"')
                ->where('presensi.nik', $nik)
                ->count();
            $max_izinpenting = $izinpenting->jml_izinpenting - $izinpenting_digunakan;
        } else {
            $max_izinpenting = $izinpenting->jml_izinpenting;
        }
        return $max_izinpenting;
    }
}
