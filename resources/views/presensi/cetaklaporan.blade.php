@php
    function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page { size: A4
  } 
  #title{
    font-family:Arial, Helvetica, sans-serif;
    font-size:18px;
  }
  .tabeldatakaryawan{
    margin-top: 40px;
  }
  .tabeldatakaryawan 
  tr td{
    padding: 5px;
  }
  .tabelpresensi{
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
  }
  .tabelpresensi
   tr 
   th{
    border: 1px solid #131212;
    padding: 8px;
    background-color: #f0eeee;
  }
  .tabelpresensi tr td{
    border: 1px solid #131212;
    padding: 5px;
    font-size: 12px;
  }
  .foto{
    width: 40px;
    height: 30px;
  }
  body.A4.landscape .sheet{
    width: 297mm !important;
    height: auto !important;
  }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
        <tr>
            <td style="width: 100px; text-align: center">
                <h3><img src="{{ asset('assets/img/logodinkes.png') }}" width="600" alt=""></h3>
                <span id="title">LAPORAN PRESENSI KARYAWAN <br>
                PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}</span><br>
            </td>
        </tr>
    </table>
    <table class="tabeldatakaryawan">
        <tr>
            <td rowspan="6">
                @php
                    $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                @endphp
                <img src="{{ url($path) }}" alt="" width="120px" height="150">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $karyawan->nik }}</td>
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td>:</td>
            <td>{{ $karyawan->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $karyawan->jabatan }}</td>
        </tr>
        <tr>
            <td>Bidang</td>
            <td>:</td>
            <td>{{ $karyawan->nama_dept }}</td>
        </tr>
        <tr>
            <td>No.HP</td>
            <td>:</td>
            <td>{{ $karyawan->no_hp }}</td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Foto</th>
            <th>Jam Pulang</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Jml Jam</th>
        </tr>
        @foreach ($presensi as $d)
        @if ($d->status == "h")
            @php
                $path_in = Storage::url('uploads/absensi/'.$d->foto_in);
                $path_out = Storage::url('uploads/absensi/'.$d->foto_out);
                $jamterlambat = hitungjamkerja($d->jam_masuk, $d->jam_in);
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</td>
                <td>{{ $d->jam_in }}</td>
                <td><img src="{{ url($path_in) }}" alt="" class="foto"></td>
                <td>{{ $d->jam_out !=null ? $d->jam_out : 'Belum absen' }}</td>
                <td>
                  @if ($d->jam_out != null)
                      <img src="{{ url($path_out) }}" alt="" class="foto">
                  @else
                  <img src="{{ asset('assets/img/camera.jpeg') }}" alt="" class="foto">
                  @endif
                </td>
                <td style="text-align: center">{{ $d->status }}</td>
                <td>
                  @if ($d->jam_in > $d->jam_masuk)
                  @php
                      $jamterlambat = selisih($d->jam_masuk, $d->jam_in);
                  @endphp
                  <span class="badge bg-danger">Terlambat {{ $jamterlambat }}</span>
                  @else
                  <span class="badge bg-success">Tepat waktu</span>
                  @endif
                </td>
                <td>
                  @if ($d->jam_out != null)
                    @php
                    $tgl_masuk = $d->tgl_presensi;
                    $tgl_pulang = $d->lintashari == 1 ? date('Y-m-d', strtotime
                    ('+1 days', strtotime($tgl_masuk))) : $tgl_masuk;
                    $jam_masuk = $tgl_masuk. ' ' .$d->jam_in;
                    $jam_pulang = $tgl_pulang. ' ' .$d->jam_out;

                    $jmljamkerja = hitungjamkerja($d->jam_masuk, $d->jam_pulang);
                    @endphp
                      @else
                      @php
                          $jmljamkerja = 0;
                      @endphp
                  @endif
                  {{ $jmljamkerja }}
                </td>
            </tr>
            @else
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align: center">{{ $d->status }}</td>
              <td>{{ $d->keterangan }}</td>
              <td></td>
          </tr>
        @endif  
        @endforeach
    </table>
    <table width="100%" style="margin-top: 10px">
      <tr>
        <td style="text-align: center">Mengetahui,</td>
        <td style="text-align: center">Bangkinang, {{ date('d-m-Y') }}</td>
      </tr>
        <tr>
          <td style="text-align: center; vertical-align:bottom" height="100px">
            <U>ARIANTO,SKM.,MPH</U><br>
            <i><b>Sekretaris</b></i>
          </td>
          <td style="text-align: center; vertical-align:bottom" height="100px"">
            <U>MUSMULYADI,SKM.,MKM</U><br>
            <i><b>Kasubbag HKU</b></i>
          </td>
        </tr>
    </table>
  </section>
</body>
</html>