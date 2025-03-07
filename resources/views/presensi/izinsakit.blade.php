@extends('layouts.admin.tabler')
@section('content')

<div class="page-header d-print-none">
    <div class="container-fluid">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          
          <h2 class="page-title">
          Data Dinas luar/Cuti/Izin
          </h2>
        </div>
        </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session::get('warning'))
                    <div class="alert alert-warning">
                            {{ Session::get('warning') }}
                    </div>
                    @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="/presensi/izinsakit" method="GET", autocomplete="off">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  
                                  width="24"  height="24"  viewBox="0 0 24 24"  
                                  fill="none"  stroke="currentColor"  stroke-width="2"  
                                  stroke-linecap="round"  stroke-linejoin="round"  
                                  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 
                                  -2 -2v-12z" />
                                  <path d="M16 3v4" />
                                  <path d="M8 3v4" />
                                  <path d="M4 11h16" />
                                  <path d="M8 14v4" />
                                  <path d="M12 14v4" />
                                  <path d="M16 14v4" />
                                </svg>
                                </span>
                                <input type="text" value="{{ Request('dari') }}" id="dari" class="form-control" 
                                placeholder="Dari" name="dari">
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  
                                  width="24"  height="24"  viewBox="0 0 24 24"  
                                  fill="none"  stroke="currentColor"  stroke-width="2"  
                                  stroke-linecap="round"  stroke-linejoin="round"  
                                  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 
                                  -2 -2v-12z" />
                                  <path d="M16 3v4" />
                                  <path d="M8 3v4" />
                                  <path d="M4 11h16" />
                                  <path d="M8 14v4" />
                                  <path d="M12 14v4" />
                                  <path d="M16 14v4" />
                                </svg>
                            </span>
                                <input type="text" value="{{ Request('sampai') }}" id="sampai" class="form-control" 
                                placeholder="Sampai" name="sampai">
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                  height="24"  viewBox="0 0 24 24"  fill="none"  
                                  stroke="currentColor"  stroke-width="2"  
                                  stroke-linecap="round"  stroke-linejoin="round"  
                                  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                                  <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                                  <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                                  <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                                  <path d="M5 11h1v2h-1z" />
                                  <path d="M10 11l0 2" />
                                  <path d="M14 11h1v2h-1z" />
                                  <path d="M19 11l0 2" />
                                </svg>
                                </span>
                                <input type="text" value="{{ Request('nik') }}" id="nik" class="form-control" 
                                placeholder="NIK" name="nik">
                              </div>
                        </div>
                        <div class="col-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  
                                  width="24"  height="24"  viewBox="0 0 24 24"  
                                  fill="none"  stroke="currentColor"  stroke-width="2"  
                                  stroke-linecap="round"  stroke-linejoin="round"  
                                  class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                                </span>
                                <input type="text" value="{{ Request('nama_lengkap') }}" id="nama_lengkap" class="form-control" 
                                placeholder="Nama Pegawai" name="nama_lengkap">
                              </div>
                        </div>
                        @role('administrator','user')
                        <div class="col-2">
                            <div class="form-group">
                            <select name="kode_cabang" id="kode_cabang" class="form-select">
                                <option value="">Semua Kantor</option>
                                @foreach ($cabang as $d)
                                    <option {{ Request('kode_cabang') == $d->kode_cabang ? 'selected' : '' }}
                                    value="{{ $d->kode_cabang }}">{{ strtoupper($d->nama_cabang) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                        <select name="kode_dept" id="kode_dept" class="form-select">
                            <option value="">Semua Bidang</option>
                            @foreach ($departemen as $d)
                                <option {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }} 
                                    value="{{ $d->kode_dept }}">{{ strtoupper($d->nama_dept) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endrole
                        <div class="col-2">
                            <div class="form-group">
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="0" {{ Request('status_approved')== '0' ? 'selected':'' }}>Pending</option>
                                    <option value="1"{{ Request('status_approved')==1 ? 'selected':'' }}>Disetujui</option>
                                    <option value="2"{{ Request('status_approved')==2 ? 'selected':'' }}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  
                                    width="24"  height="24"  viewBox="0 0 24 24"  
                                    fill="none"  stroke="currentColor"  stroke-width="2"  
                                    stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                                
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Izin</th>
                        <th>Tanggal</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>Bidang</th>
                        <th>Kantor</th>
                        <th>Status</th>
                        <th>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" /></svg>
                        </th>
                        <th>Keterangan</th>
                        <th>Approval</th>
                        @role('administrator', 'user')
                        <th>Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($izinsakit as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->kode_izin }}</td>
                            <td>
                                {{ date('d-m-Y', strtotime($d->tgl_izin_dari)) }} s/d 
                                {{ date('d-m-Y', strtotime($d->tgl_izin_sampai)) }}
                            </td>
                            <td>{{ $d->nik }}</td>
                            <td>{{ $d->nama_lengkap }}</td>
                            <td>{{ $d->jabatan }}</td>
                            <td>{{ $d->kode_dept }}</td>
                            <td>{{ $d->kode_cabang }}</td>
                            <td>
                                @if ($d->status=="i")
                                    Izin
                                @elseif($d->status=="s")
                                    Sakit
                                @elseif($d->status=="d")
                                    Dinas luar
                                @elseif($d->status=="p")
                                    Izin 
                                @elseif($d->status=="c")
                                    Cuti      
                                @endif
                            </td>
                            <td>
                                @if (!empty($d->doc_sid))
                                    @php
                                        $path = Storage::url('uploads/sid/'.$d->doc_sid);
                                    @endphp
                                   <a href="{{ url($path) }}" target="_blank">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" /></svg>
                                </a>     
                                @endif
                            </td>
                            <td>{{ $d->keterangan }}</td>
                            <td>
                                @if ($d->status_approved==1)
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($d->status_approved == 2)
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            @role('administrator', 'user')
                            <td>
                                @if ($d->status_approved == 0)
                                    <a href="3" class="btn btn-sm btn-primary approve"  
                                    kode_izin="{{ $d->kode_izin }}">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  
                                    width="24"  height="24"  viewBox="0 0 24 24"  
                                    fill="none"  stroke="currentColor"  stroke-width="2"  
                                    stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                    <path d="M11 13l9 -9" />
                                    <path d="M15 4h5v5" />
                                </svg>
                                Proses
                                </a>
                                @else
                                <a href="/presensi/{{ $d->kode_izin }}/batalkanizinsakit" class="btn btn-sm btn-danger">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                    height="24"  viewBox="0 0 24 24"  fill="currentColor"  
                                    class="icon icon-tabler icons-tabler-filled icon-tabler-square-x">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M19 2h-14a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3 
                                    -3v-14a3 3 0 0 0 -3 -3zm-9.387 6.21l.094 .083l2.293 2.292l2.293 
                                    -2.292a1 1 0 0 1 1.497 1.32l-.083 .094l-2.292 2.293l2.292 2.293a1 
                                    1 0 0 1 -1.32 1.497l-.094 -.083l-2.293 -2.292l-2.293 2.292a1 
                                    1 0 0 1 -1.497 -1.32l.083 -.094l2.292 -2.293l-2.292 -2.293a1 
                                    1 0 0 1 1.32 -1.497z" />
                                </svg>
                                Batalkan
                                </a>
                                @endif
                            </td>
                            @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $izinsakit->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Dinas luar/Cuti/Izin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/presensi/approveizinsakit" method="POST">
                @csrf
                <input type="hidden" id="kode_izin_form" name="kode_izin_form">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="status_approved" id="status_approved" class="form-select">
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100" type="submit">
                                <svg  xmlns="http://www.w3.org/2000/svg"  
                                width="24"  height="24"  viewBox="0 0 24 24"  
                                fill="none"  stroke="currentColor"  stroke-width="2"  
                                stroke-linecap="round"  stroke-linejoin="round"  
                                class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 14l11 -11" />
                                <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 
                                1 0 -1l18 -6.5" />
                            </svg>
                            Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
 </div>

@endsection

@push('myscript')
 <script>
    $(function(){
        $(".approve").click(function(e){
            e.preventDefault()
            var kode_izin = $(this).attr("kode_izin");
            $("#kode_izin_form").val(kode_izin);
            $("#modal-izinsakit").modal("show");
        });
        $("#dari, #sampai").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                format: 'yyyy-mm-dd'
        });
    });
 </script>
@endpush