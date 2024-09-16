@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          
          <h2 class="page-title">
            Data Kantor
          </h2>
        </div>
        </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                <a href="#" class="btn btn-primary" id="btnTambahCabang">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                    height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                                    stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline 
                                    icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                            <form action="/cabang" method="GET">
                            <div class="row">
                                <div class="col-10">
                                    <select name="kode-cabang" class="form-select" id="">
                                        <option value="Semua cabang"></option>
                                    </select>
                                </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  
                                        width="24"  height="24"  viewBox="0 0 24 24"  
                                        fill="none"  stroke="currentColor"  stroke-width="2"  
                                        stroke-linecap="round"  stroke-linejoin="round"  
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                    Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kantor</th>
                            <th>Nama kantor</th>
                            <th>Lokasi</th>
                            <th>radius</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabang as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->kode_cabang }}</td>
                            <td>{{ $d->nama_cabang }}</td>
                            <td>{{ $d->lokasi_cabang }}</td>
                            <td>{{ $d->radius_cabang }} Meter</td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" class="edit btn btn-info btn-sm" kode_cabang="{{ $d->kode_cabang }}">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                    height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="currentColor"  stroke-width="2"  
                                    stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 
                                    -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                            </a>
                                <form action="/cabang/{{ $d->kode_cabang }}/delete" method="POST" 
                                    style="margin-left:5px">
                                    @csrf
                                    <a class="btn btn-danger btn-sm delete-confirm">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  
                                        width="24"  height="24"  viewBox="0 0 24 24"  
                                        fill="none"  stroke="currentColor"  
                                        stroke-width="2"  stroke-linecap="round"  
                                        stroke-linejoin="round"  
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                    </a>
                                </form>
                                </div>
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-inputcabang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Kantor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/cabang/store" method="POST" id="frmCabang">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  
                          width="24"  height="24"  viewBox="0 0 24 24"  
                          fill="none"  stroke="currentColor"  stroke-width="2"  
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
                        <input type="text" value="" id="kode_cabang" class="form-control" 
                        placeholder="Kode Kantor" name="kode_cabang">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  
                          width="24"  height="24"  viewBox="0 0 24 24"  
                          fill="none"  stroke="currentColor"  stroke-width="2"  
                          stroke-linecap="round"  stroke-linejoin="round"  
                          class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                          <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        </span>
                        <input type="text" value="" id="nama_cabang" class="form-control" 
                        name="nama_cabang" placeholder="Nama Kantor">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  
                          width="24"  height="24"  viewBox="0 0 24 24"  
                          fill="none"  stroke="currentColor"  stroke-width="2"  
                          stroke-linecap="round"  stroke-linejoin="round"  
                          class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin-check">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                          <path d="M11.87 21.48a1.992 1.992 0 0 1 -1.283 
                          -.58l-4.244 -4.243a8 8 0 1 1 13.355 -3.474" />
                          <path d="M15 19l2 2l4 -4" />
                        </svg>
                        </span>
                        <input type="text" value="" id="lokasi_cabang" class="form-control" 
                        name="lokasi_cabang" placeholder="Lokasi Kantor">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                          height="24"  viewBox="0 0 24 24"  fill="none"  
                          stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                          stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-radar-2">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                          <path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" />
                          <path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" />
                          <path d="M12 12v9" />
                        </svg>
                        </span>
                        <input type="text" value="" id="radius_cabang" class="form-control" 
                        name="radius_cabang" placeholder="Radius Kantor">
                      </div>
                </div>
            </div>
            <div class="row mt-2">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-primary w-100">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                        height="24"  viewBox="0 0 24 24"  fill="none"  
                        stroke="currentColor"  stroke-width="2"  
                        -linecap="round"  stroke-linejoin="round"  
                        class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 14l11 -11" />
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                    </svg>
                    Simpan
                </button>
                </div>
            </div>
        </div>
        </form>
        </div>
      </div>
    </div>
 </div> 

 {{-- //Modal Edit --}}
 <div class="modal modal-blur fade" id="modal-editcabang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Kantor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">
        </div>
      </div>
    </div>
 </div> 
@endsection

@push('myscript')
   <script>
    $(function(){
        $("#btnTambahCabang").click(function(){
            $("#modal-inputcabang").modal("show");
        });

        $(function(){
            $(".edit").click(function(){
            var kode_cabang = $(this).attr('kode_cabang');
            $.ajax({
                type:'POST',
                url:'/cabang/edit',
                cache:false,
                data:{
                    _token:"{{ csrf_token(); }}",
                    kode_cabang:kode_cabang
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editcabang").modal("show");
        });

        $(".delete-confirm").click(function(e){
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
            title: "Apakah anda yakin data ini mau di hapus?",
            text: "Jika ya, maka data akan terhapus permanen",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!"
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Deleted!',
                'Data berhasil dihapus',
                'success'
                )
             }
            })
        });
        $("#frmCabang").submit(function(){
            var kode_cabang = $("#kode_cabang").val();
            var nama_cabang = $("#nama_cabang").val();
            var lokasi_cabang = $("#lokasi_cabang").val();
            var radius_cabang = $("#radius_cabang").val();
            if(kode_cabang==""){
                //alert('kode harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode Kantor harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#kode_cabang").focus();
                    });
                return false;
            }else if (nama_cabang==""){
                //alert('nama harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Kantor harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#nama_cabang").focus();
                    });
                return false;
            }else if (lokasi_cabang==""){
                //alert('lokasi harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Lokasi Kantor harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#lokasi_cabang").focus();
                    });
                return false;
            }else if (radius_cabang==""){
                //alert('radius harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Radius Kantor harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#radius_cabang").focus();
                    });
                return false;
            }
        });
    });
});
    </script> 
@endpush