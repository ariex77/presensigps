@extends('layouts.presensi')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pagetitle">Data Izin/Sakit</div>
        <div class="right"></div>
    </div>
    <style>
        .historicontent{
        display: flex;
        gap: 1px;
        }
        .datapresensi{
        margin-left: 10px;
        }
        .status{
           position: absolute;
           right: 20px; 
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
        @foreach ($dataizin as $d)
        @php
            if ($d->status == "i") {
                $status ="Izin";
            }else if($d->status=="s"){
                $status ="Sakit";
            }elseif($d->status == "c"){
                $status ="Cuti";
            }else{
                $status ="Not found";
            }
        @endphp
        <div class="card mt-1">
            <div class="card-body">
                <div class="historicontent">
                    <div class="iconpresensi">
                        @if ($d->status=="i")
                            <ion-icon name="document-outline" style="font-size: 48px; color:blue"></ion-icon>
                        @elseif($d->status=="s")
                        <ion-icon name="medkit-outline" style="font-size: 48px; color:rgb(255, 0, 60)"></ion-icon>
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
                            @if (!empty($d->doc_sid))
                            <span style="color:blue">
                                <ion-icon name="document-attach-outline"></ion-icon>Lihat SID
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

        {{--    <ul class="listview image-listview">
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
		<a class="dropdown-item bg-primary" href="/izincuti">
			<ion-icon name="document-outline" role="img" class="md-hydrated" aria-label="videocam outline"></ion-icon>
			<p>Cuti</p>
		</a>
	</div>
</div>

@endsection