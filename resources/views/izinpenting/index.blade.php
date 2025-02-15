@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          
          <h2 class="page-title">
            Data Izin Alasan Penting
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
                                <a href="#" class="btn btn-primary" id="btnTambahIzinpenting">
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
                    </div>
                </div>
                        <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Izin Alasan Penting</th>
                            <th>Nama Izin Alasan Penting</th>
                            <th>Jumlah Izin Alasan Penting</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinpenting as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->kode_izinpenting }}</td>
                                <td>{{ $d->nama_izinpenting }}</td>
                                <td>{{ $d->jml_izinpenting }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="edit btn btn-info btn-sm" kode_izinpenting="{{ $d->kode_izinpenting }}">
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
                                    <form action="/izinpenting/{{ $d->kode_izinpenting }}/delete" method="POST" 
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
  <div class="modal modal-blur fade" id="modal-inputizinpenting" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Izin Alasan Penting</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/izinpenting/store" method="POST" id="frmizinpenting">
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
                        <input type="text" value="" id="kode_izinpenting" class="form-control" 
                        placeholder="Kode Izin Alasan Penting" name="kode_izinpenting">
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
                        <input type="text" value="" id="nama_izinpenting" class="form-control" 
                        name="nama_izinpenting" placeholder="Nama Izin Alasan Penting">
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
                        <input type="text" value="" id="jml_izinpenting" class="form-control" 
                        name="jml_izinpenting" placeholder="Jumlah Izin Alasan Penting">
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
 <div class="modal modal-blur fade" id="modal-editizinpenting" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Izin Alasan Penting</h5>
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
        $("#btnTambahIzinpenting").click(function(){
            $("#modal-inputizinpenting").modal("show");
        });

        $(function(){
            $(".edit").click(function(){
            var kode_izinpenting = $(this).attr('kode_izinpenting');
            $.ajax({
                type:'POST',
                url:'/izinpenting/edit',
                cache:false,
                data:{
                    _token:"{{ csrf_token(); }}",
                    kode_izinpenting:kode_izinpenting
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editizinpenting").modal("show");
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
        });
        $("#frmizinpenting").submit(function(){
            var kode_izinpenting = $("#kode_izinpenting").val();
            var nama_izinpenting = $("#nama_izinpenting").val();
            var jml_izinpenting = $("#jml_izinpenting").val();
            if(kode_izinpenting==""){
                //alert('kode dinas luar harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode dinas luar harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#kode_izinpenting").focus();
                    });
                return false;
            }else if (nama_izinpenting==""){
                //alert('nama dinas luar harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama dinas luar harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#nama_izinpenting").focus();
                    });
                return false;
            }else if (jml_izinpenting=="" || jml_izinpenting==0){
                //alert('jumlah izin alasan penting harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jumlah izin alasan penting harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#jml_izinpenting").focus();
                    });
                return false;
        }
    });
});
</script> 
@endpush