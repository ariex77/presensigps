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
    font-size:14px;
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
  .tabelpresensi tr th{
    border: 1px solid #131212;
    padding: 8px;
    background-color: #f0eeee;
    font-size: 5px
  }
  .tabelpresensi tr td{
    border: 1px solid #131212;
    padding: 5px;
    font-size: 5px;
  }
  .foto{
    width: 40px;
    height: 30px;
  }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
        <tr>
            <td style="width: 100px; text-align: center">
                <h3><img src="{{ asset('assets/img/logodinkes.png') }}" width="600" alt=""></h3>
                <span id="title">
                    REKAP PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}</span><br>
            </td>
        </tr>
    </table>

    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">NIK</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TT</th>
        </tr>
        <tr>
            <?php 
            for($i=1; $i<=31; $i++){
                ?>
                <th>{{ $i }}</th>
                <?php
            }
            ?> 
        </tr>
        <tr>
            @foreach ($rekap as $d)
                <tr>
                    <td>{{ $d->nik }}</td>
                    <td>{{ $d->nama_lengkap }}</td>
                <?php
                $totalhadir = 0;
                $totalterlambat = 0;
                for($i=1; $i<=31; $i++){
                    $tgl = "tgl_".$i;       
                    if (empty($d->$tgl)) {
                        $hadir = ['',''];
                        $totalhadir += 0;
                        
                    }else {
                        $hadir = explode("-",$d->$tgl);
                        $totalhadir += 1;
                        if($hadir[0] > $d->jam_masuk){
                            $totalterlambat += 1;
                        }
                    }
                    ?>
                    <td>
                        <span style="color: {{ $hadir [0]>$d->jam_masuk ? "red": "" }}" > 
                          {{ !empty($hadir [0] && $d->$tgl) ? $hadir[0] : '-' }}</span><br>
                        <span style="color: {{ $hadir [1]<$d->jam_pulang ? "red": "" }}" > 
                          {{ !empty($hadir [1] && $d->$tgl) ? $hadir[1] : '-' }}</span><br>
                    </td>
                    <?php
                }
                ?>
                <td>{{ $totalhadir }}</td>
                <td>{{ $totalterlambat }}</td>
                </tr>
            @endforeach
        </tr>
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
          <td style="text-align: center; vertical-align:bottom" height="100px">
            <U>MUSMULYADI,SKM.,MKM</U><br>
            <i><b>Kasubbag HKU</b></i>
          </td>
        </tr>
    </table>
  </section>
</body>
</html>