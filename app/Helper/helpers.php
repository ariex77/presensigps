<?php

use Illuminate\Support\Facades\DB;

function hitungjamterlambat($jadwal_jam_masuk, $jam_presensi)
{
    $j1 = strtotime($jadwal_jam_masuk);
    $j2 = strtotime($jam_presensi);

    $diffterlambat = $j2 - $j1;

    $jamterlambat = floor($diffterlambat / (60 * 60));
    $menitterlambat = floor(($diffterlambat - ($jamterlambat * (60 * 60))) / 60);

    $jterlambat = $jamterlambat <= 9 ? "0" . $jamterlambat : $jamterlambat;
    $mterlambat = $menitterlambat <= 9 ? "0" . $menitterlambat : $menitterlambat;

    $terlambat = $jterlambat . ":" . $mterlambat;
    return $terlambat;
}

function hitungjamterlambatdesimal($jadwal_jam_masuk, $jam_presensi)
{
    $j1 = strtotime($jadwal_jam_masuk);
    $j2 = strtotime($jam_presensi);

    $diffterlambat = $j2 - $j1;

    $jamterlambat = floor($diffterlambat / (60 * 60));
    $menitterlambat = floor(($diffterlambat - ($jamterlambat * (60 * 60))) / 60);

    $jterlambat = $jamterlambat <= 9 ? "0" . $jamterlambat : $jamterlambat;
    $mterlambat = $menitterlambat <= 9 ? "0" . $menitterlambat : $menitterlambat;

    $desimalterlambat = $jamterlambat + ROUND(($menitterlambat / 60), 2);

    return $desimalterlambat;
}


//Menghitung Hari
function hitunghari($tanggal_mulai, $tanggal_akhir)
{
    $tanggal_1 = date_create($tanggal_mulai);
    $tanggal_2 = date_create($tanggal_akhir); // waktu sekarang
    $diff = date_diff($tanggal_1, $tanggal_2);
    return $diff->days + 1;
}

function hitungdenda($jam_terlambat)
{
    $j_terlambat = explode(":", $jam_terlambat);
    $jam = $j_terlambat[0];
    $menit = $j_terlambat[1];
    if ($jam > 7) {
        if ($jam >= 7) {
            $denda = 0.009;
        } elseif ($jam >= 14) {
            $denda = 0.018;
        } elseif ($jam >= 21) {
            $denda = 0.027;
        } elseif ($jam >= 28) {
            $denda = 0.036;
        } elseif ($jam >= 35) {
            $denda = 0.3;
        } else {
            $denda = 0;
        }
        return $denda;
    }
}


function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0)
{
    /* mencari nomor baru dengan memecah nomor terakhir dan menambahkan 1
    string nomor baru dibawah ini harus dengan format XXX000000
    untuk penggunaan dalam format lain anda harus menyesuaikan sendiri */
    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
    //    menambahkan nol didepan nomor baru sesuai panjang jumlah karakter
    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
    //    menyusun kunci dan nomor baru
    $kode = $kunci . $nomor_baru_plus_nol;
    return $kode;
}

function hitungjamkerja($tgl_presensi, $jam_mulai, $jam_pulang, $max_total_jam, $lintashari, $awal_jam_istirahat, $akhir_jam_istirahat)
{
    if ($lintashari == '1') {
        $tgl_pulang = date("Y-m-d", strtotime("+1 days", strtotime($tgl_presensi)));
    } else {
        $tgl_pulang = $tgl_presensi;
    }
    $jam_mulai = $tgl_presensi . " " . $jam_mulai;
    $jam_pulang = $tgl_pulang . " " . $jam_pulang;

    if ($awal_jam_istirahat != "NA") {
        $awal_jam_istirahat = $tgl_pulang . " " . $awal_jam_istirahat;
        $akhir_jam_istirahat = $tgl_pulang . " " . $akhir_jam_istirahat;
        if ($jam_pulang > $awal_jam_istirahat && $jam_pulang <= $akhir_jam_istirahat) {
            $jam_pulang = $awal_jam_istirahat;
        }
    }

    $j_mulai = strtotime($jam_mulai);
    $j_pulang = strtotime($jam_pulang);
    $diff = $j_pulang - $j_mulai;
    if (empty($j_pulang)) {
        $jam = 0;
        $menit = 0;
    } else {
        $jam = floor($diff / (60 * 60));
        $m = $diff - $jam * (60 * 60);
        $menit = floor($m / 60);
    }

    $menitdesimal = ROUND($menit / 60, 2);
    /*jika pegawai pulang setelah jam istirahat, maka total jam kerja dikurangi 1 jam, 
    jika kurang dari jam istirahat tidak dikurangi 1 jam*/

    if ($awal_jam_istirahat != "NA") {
        if ($jam_pulang > $akhir_jam_istirahat) {
            $jam_istirahat = 1;
        } else {
            $jam_istirahat = 0;
        }
    } else {
        $jam_istirahat = 0;
    }

    $jamdesimal = $jam - $jam_istirahat + $menitdesimal;
    $totaljam = $jamdesimal > $max_total_jam ? $max_total_jam : $jamdesimal;
    return $totaljam;
}

function getkaryawanlibur($dari, $sampai)
{
    $datalibur = DB::table('harilibur_detail')
        ->join('harilibur', 'harilibur_detail.kode_libur', '=', 'harilibur.kode_libur')
        ->whereBetween('tanggal_libur', [$dari, $sampai])
        ->get();

    $karyawanlibur = [];
    foreach ($datalibur as $d) {
        $karyawanlibur[] = [
            'nik' => $d->nik,
            'tanggal_libur' => $d->tanggal_libur,
            'keterangan' => $d->keterangan
        ];
    }
    return $karyawanlibur;
}

function cekkaryawanlibur($array, $search_list)
{
    //create the result array
    $result = array();

    //iterate over each array element
    foreach ($array as $key => $value) {

        //iterate over each search condition
        foreach ($search_list as $k => $v) {

            //if the array element does not meet
            //the search condition then continue
            //to the next element
            if (!isset($value[$k]) || $value[$k] != $v) {

                //skip two loops
                continue 2;
            }
        }
        //Append array element's key to the
        //result array
        $result[] = $value;
    }
    //return result
    return $result;
}
function gethari($hari)
{
    //$hari = date("D");
    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jum'at";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak diketahui";
            break;
    }
    return $hari_ini;
}
