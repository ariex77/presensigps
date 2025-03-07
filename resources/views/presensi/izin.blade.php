@extends('layouts.presensi')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pagetitle">Data Dinas luar/Cuti/Izin</div>
        <div class="right"></div>
    </div>
    <style>
        .historicontent{
        display: flex;
        gap: 1px;
        margin-top: 15px;
        }
        .datapresensi{
        margin-left: 10px;
        }
        .status{
           position: absolute;
           right: 20px; 
        }
        .card{
            border: 1px solid blue;
        }
    </style>
    <!-- * App Header -->

@endsection

@section('content')
<div class="row">
    <div class="col" style="margin-top: 70px">
        @php
            $messagesuccess = Session::get('success');
            $messageerror = Session::get('error');
        @endphp
        @if (Session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess }}
        </div>
        @endif
        @if (Session::get('error'))
        <div class="alert alert-danger">
            {{ $messageerror }}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        <form method="GET" action="/presensi/izin">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <select name="bulan" id="bulan" class="form-control selectmaterialize">
                            <option value="">Bulan</option>
                            @for($i = 1; $i<=12; $i++)
                            <option {{ Request('bulan')== $i ? 'selected' : ''}} 
                            value="{{ $i }}">{{ $namabulan[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control selectmaterialize">
                            <option value="">Tahun</option>
                            @php
                                $tahun_awal = 2024;
                                $tahun_sekarang = date("Y");
                                for($t = $tahun_awal; $t <= $tahun_sekarang; $t++){
                                    if(Request('tahun')==$t){
                                        $selected = 'selected';
                                    }else{
                                        $selected='';
                                    }
                                    echo "<option $selected value='$t'>$t</option>";}
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary w-100">Cari data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row" style="position: fixed; width:100%; margin:auto; overflow-y:scroll; height: 430px">
    <div class="col">
        @foreach ($dataizin as $d)
        @php
            if ($d->status == "i") {
                $status ="Izin";
            }else if($d->status=="s"){
                $status ="Sakit";
            }elseif($d->status == "c"){
                $status ="Cuti";
            }elseif($d->status == "d"){
                $status ="Dinas Luar";
            }elseif($d->status == "p"){
                $status ="Izin Alasan Penting";
            }else{
                $status ="Not found";
            }
        @endphp
        <div class="card mt-1 card_izin" kode_izin="{{ $d->kode_izin }}" status_approved="{{ $d->status_approved }}" 
            data-toggle="modal" data-target="#actionSheetIconed">
            <div class="card-body">
                <div class="historicontent">
                    <div class="iconpresensi">
                        @if ($d->status=="i")
                            <ion-icon name="document-outline" style="font-size: 48px; color:blue"></ion-icon>
                        @elseif($d->status=="s")
                        <ion-icon name="medkit-outline" style="font-size: 48px; color:rgb(255, 0, 60)"></ion-icon>
                        @elseif($d->status=="d")
                        <ion-icon name="car-sport-outline" style="font-size: 48px; color:rgb(0, 255, 170)"></ion-icon>
                        @elseif($d->status=="p")
                        <ion-icon name="walk-outline" style="font-size: 48px; color:rgb(0, 255, 170)"></ion-icon>
                        @elseif($d->status=="c")
                        <ion-icon name="calendar-number-outline" style="font-size: 48px; color:rgb(0, 255, 170)"></ion-icon>
                        @endif
                        
                    </div>
                    <div class="datapresensi">
                        <h3 style="line-height: 2px">{{ date("d-m-Y", strtotime($d->tgl_izin_dari)) }}
                            ({{ $status }})
                        </h3>
                        <small>{{ date("d-m-Y", strtotime($d->tgl_izin_dari)) }} s/d 
                            {{ date("d-m-Y", strtotime($d->tgl_izin_sampai)) }}
                        </small>
                        <p>
                            {{ $d->keterangan }}
                            <br>
                            @if ($d->status=="c")
                                <span class="badge bg-warning">{{ $d->nama_cuti }}</span>
                            @endif
                            @if ($d->status=="d")
                                <span class="badge bg-warning">{{ $d->nama_dinasluar }}</span>
                            @endif
                            @if ($d->status=="p")
                                <span class="badge bg-warning">{{ $d->nama_izinpenting }}</span>
                            @endif 
                            @if (!empty($d->doc_sid))
                            <span style="color:blue">
                                <ion-icon name="document-attach-outline"></ion-icon>Lihat SPT
                            </span>
                            @endif
                        </p>
                        
                    </div>
                        <div class="status">
                            @if ($d->status_approved==0)
                            <span class="badge bg-warning">Menunggu</span>
                            @elseif($d->status_approved=="1")
                            <span class="badge bg-success">Disetujui</span>
                            @elseif($d->status_approved=="2")
                            <span class="badge bg-danger">Ditolak</span>
                            @endif
                            <p style="margin-top: 5px; font-weight: bold">{{ hitunghari($d->tgl_izin_dari, $d->tgl_izin_sampai) }} Hari</p>
                    </div> 
                </div>
            </div>
        </div>

        {{-- <ul class="listview image-listview">
                <li>
                    <div class="item">
                        <div class="in">
                            <div>
                                <b>{{ date("d-m-Y",strtotime($d->tgl_izin_dari)) }}({{ $d->status=="s" ? "Sakit" : "izin"}})</b><br>
                                <small class="text-muted">{{ $d->keterangan }}</small>
                            </div>
                            @if ($d->status_approved == 0)
                                <span class="badge bg-warning">Waiting</span>
                                @elseif($d->status_approved == 1)
                                <span class="badge bg-success">Approved</span>
                                @elseif($d->status_approved == 2)
                                <span class="badge bg-danger">Decline</span>
                            @endif
                        </div>
                    </div>
                </li>
            </ul> --}}
        @endforeach
    </div>
</div>
</div>
<div class="fab-button animate bottom-right dropdown" style="margin-bottom:70px">
	<a href="#" class="fab bg-primary" data-toggle="dropdown">
		<ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
	</a>
	<div class="dropdown-menu">
		<a class="dropdown-item bg-primary" href="/izinabsen">
			<ion-icon name="document-outline" role="img" class="md-hydrated" aria-label="image outline"></ion-icon>
			<p>Izin Absen</p>
		</a>
		<a class="dropdown-item bg-primary" href="/izinsakit">
			<ion-icon name="document-outline" role="img" class="md-hydrated" aria-label="videocam outline"></ion-icon>
			<p>Sakit</p>
		</a>
		<a class="dropdown-item bg-primary" href="/izindinasluar">
			<ion-icon name="document-outline" role="img" class="md-hydrated" aria-label="videocam outline"></ion-icon>
			<p>Dinas Luar</p>
		</a>
        <a class="dropdown-item bg-primary" href="/izincuti">
			<ion-icon name="document-outline" role="img" class="md-hydrated" aria-label="videocam outline"></ion-icon>
			<p>Cuti</p>
		</a>
        <a class="dropdown-item bg-primary" href="/izinalasanpenting">
			<ion-icon name="document-outline" role="img" class="md-hydrated" aria-label="videocam outline"></ion-icon>
			<p>Izin Alasan Penting</p>
		</a>
	</div>
</div>

<div class="modal fade action-sheet" id="actionSheetIconed" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aksi</h5>
            </div>
            <div class="modal-body" id="showact">
 
            </div>
        </div>
    </div>
</div>

    <div class="modal fade dialogbox" id="deleteConfirm" data-backdrop="static" tabindex="-1" role="dialog">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Yakin Dihapus ?</h5>
	            </div>
	                <div class="modal-body">
    	                Data Pengajuan Izin Akan dihapus
    	            </div>
    	            <div class="modal-footer">
    	                <div class="btn-inline">
    	                    <a href="#" class="btn btn-text-secondary" data-dismiss="modal">Batalkan</a>
    	                    <a href="" class="btn btn-text-primary" id="hapuspengajuan">Hapus</a>
    	                </div>
    	        </div>
    	    </div>
        </div>
    </div>
    

@endsection

@push('myscript')
<script>
    $(function(){
        $(".card_izin").click(function(e){
            var kode_izin = $(this).attr("kode_izin");
            var status_approved = $(this).attr("status_approved");
            if(status_approved==1){
                Swal.fire({
                    title: 'Oops!',
                    text: 'Data sudah disetujui, tidak dapat diubah!',
                    icon: 'Warning'
                })
            }else{
                $("#showact").load('/izin/' + kode_izin +'/showact');
            }
        });
    });
</script>
    
@endpush