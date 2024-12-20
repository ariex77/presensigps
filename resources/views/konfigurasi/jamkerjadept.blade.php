@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-px">
          <!-- Page pre-title -->
          
            <h2 class="page-title">
                Konfigurasi Jam Kerja Bidang
            </h2>
            </div>
        </div>
    </div>
</div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row">
          <div class="col-8">
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
                            <a href="/konfigurasi/jamkerjadept/create" class="btn btn-primary" id="btnTambahJK">
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
                    </div>
                    <div class="row mt-2">
                      <div class="col-12">
                          <table class="table table-bordered">
                      <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Kantor</th>
                            <th>Bidang</th>
                            <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($jamkerjadept as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->kode_jk_dept }}</td>
                                <td>{{ strtoupper($d->nama_cabang) }}</td>
                                <td>{{ strtoupper($d->nama_dept) }}</td>
                                <td>
                                    <div style="d-flex justify-content-between">
                                    <div class="btn-group">
                                        <a href="/konfigurasi/jamkerjadept/{{ $d->kode_jk_dept }}/edit" 
                                            class="edit btn btn-info btn-sm">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                        height="24"  viewBox="0 0 24 24"  fill="none"  
                                        stroke="currentColor"  stroke-width="2"  
                                        stroke-linecap="round"  stroke-linejoin="round"  
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>
                                <a href="/konfigurasi/jamkerjadept/{{ $d->kode_jk_dept }}/show" 
                                    class="btn btn-success btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  
                                    width="24"  height="24"  viewBox="0 0 24 24"  
                                    fill="none"  stroke="currentColor"  
                                    stroke-width="2"  stroke-linecap="round"  
                                    stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-stereo-glasses">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M8 3h-2l-3 9" />
                                    <path d="M16 3h2l3 9" />
                                    <path d="M3 12v7a1 1 0 0 0 1 1h4.586a1 1 0 0 0 .707 -.293l2 -2a1 1 0 0 1 
                                    1.414 0l2 2a1 1 0 0 0 .707 .293h4.586a1 1 0 0 0 1 -1v-7h-18z" />
                                    <path d="M7 16h1" /><path d="M16 16h1" />
                                </svg>
                            </a>
                            <a href="/konfigurasi/jamkerjadept/{{ $d->kode_jk_dept }}/delete" 
                                class="btn btn-danger btn-sm delete-confirm">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                height="24"  viewBox="0 0 24 24"  fill="none"  
                                stroke="currentColor"  stroke-width="2"  
                                stroke-linecap="round"  stroke-linejoin="round"  
                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 7l16 0" /><path d="M10 11l0 6" />
                                <path d="M14 11l0 6" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                            </a>
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
</div>
@endsection

@push('myscript')
    <script>
        $(function(){
            $(".delete-confirm").click(function(e){
                var url = $(this).attr('href');
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
                window.location.href =url;
                //Swal.fire(
                //'Deleted!','Data berhasil dihapus','success'
                //)
             }
            })
        });
        });
    </script>
@endpush
