@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-px">
          <!-- Page pre-title -->
          
            <h2 class="page-title">
                Konfigurasi Jam Kerja
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
                            <a href="#" class="btn btn-primary" id="btnTambahJK">
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
                              <th>Kode JK</th>
                              <th>Nama JK</th>
                              <th>Awal Jam Masuk</th>
                              <th>Jam Masuk</th>
                              <th>Akhir Jam Masuk</th>
                              <th>Jam Pulang</th>
                              <th>Total Jam</th>
                              <th>Lintas Hari</th>
                              <th>Istirahat</th>
                              <th>Awal Istirahat</th>
                              <th>Akhir Istirahat</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($jam_kerja as $d)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $d->kode_jam_kerja }}</td>
                              <td>{{ $d->nama_jam_kerja }}</td>
                              <td>{{ $d->awal_jam_masuk}}</td>
                              <td>{{ $d->jam_masuk }}</td>
                              <td>{{ $d->akhir_jam_masuk }}</td>
                              <td>{{ $d->jam_pulang }}</td>
                              <td>{{ $d->total_jam }}</td>
                              
                              <td>
                                @if ($d->lintashari==1)
                                    <span class="badge bg-success">
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                      height="24"  viewBox="0 0 24 24"  fill="none"  
                                      stroke="currentColor"  stroke-width="2"  
                                      stroke-linecap="round"  stroke-linejoin="round"  
                                      class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                      <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    </span>
                                @else
                                  <span class="badge bg-danger">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                    height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="currentColor"  stroke-width="2"  
                                    stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                  </svg>
                                  </span>
                                @endif
                              </td>
                              <td>
                                @if ($d->status_istirahat==1)
                                    <span class="badge bg-success">
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                      height="24"  viewBox="0 0 24 24"  fill="none"  
                                      stroke="currentColor"  stroke-width="2"  
                                      stroke-linecap="round"  stroke-linejoin="round"  
                                      class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                      <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    </span>
                                @else
                                  <span class="badge bg-danger">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                                    height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="currentColor"  stroke-width="2"  
                                    stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                  </svg>
                                  </span>
                                @endif
                              </td>
                              <td>{{ $d->awal_jam_istirahat }}</td>
                              <td>{{ $d->akhir_jam_istirahat }}</td>
                              <td>
                                <div class="btn-group">
                                    <a href="#" class="edit btn btn-info btn-sm" kode_jam_kerja="{{ $d->kode_jam_kerja }}">
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
                                <form action="/konfigurasi/jamkerja/{{ $d->kode_jam_kerja }}/delete" method="POST" 
                                    style="margin-left:5px">
                                    @csrf
                                    <a class="btn btn-danger btn-sm delete-confirm">
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
</div>
<div class="modal modal-blur fade" id="modal-inputjk" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Jam Kerja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/konfigurasi/storejamkerja" method="POST" id="frmJK">
          @csrf
          <div class="row">
            <div class="col-12">
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/user -->
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
                    </span>
                    <input type="text" value="" id="kode_jam_kerja" class="form-control" 
                    placeholder="Kode Jam Kerja" name="kode_jam_kerja">
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
                                    stroke="currentColor"  stroke-width="2"  
                                    stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 
                                    -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                  </span>
                  <input type="text" value="" id="nama_jam_kerja" class="form-control" 
                  placeholder="Nama Jam Kerja" name="nama_jam_kerja">
                </div>
          </div>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                      height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                      stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                      class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M12 10l0 3l2 0" />
                      <path d="M7 4l-2.75 2" />
                      <path d="M17 4l2.75 2" />
                    </svg>
                </span>
                <input type="text" value="" id="awal_jam_masuk" class="form-control" 
                placeholder="Awal Jam Masuk" name="awal_jam_masuk">
              </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12">
          <div class="input-icon mb-3">
              <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                      height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                      stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                      class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M12 10l0 3l2 0" />
                      <path d="M7 4l-2.75 2" />
                      <path d="M17 4l2.75 2" />
                    </svg>
              </span>
              <input type="text" value="" id="jam_masuk" class="form-control" 
              placeholder="Jam Masuk" name="jam_masuk">
            </div>
      </div>
  </div>
  <div class="row">
    <div class="col-12">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                      height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                      stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                      class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M12 10l0 3l2 0" />
                      <path d="M7 4l-2.75 2" />
                      <path d="M17 4l2.75 2" />
                    </svg>
            </span>
            <input type="text" value="" id="akhir_jam_masuk" class="form-control" 
            placeholder="Akhir Jam Masuk" name="akhir_jam_masuk">
          </div>
    </div>
</div>

<div class="row">
  <div class="col-12">
      <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                      height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                      stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                      class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M12 10l0 3l2 0" />
                      <path d="M7 4l-2.75 2" />
                      <path d="M17 4l2.75 2" />
                    </svg>
          </span>
          <input type="text" value="" id="jam_pulang" class="form-control" 
          placeholder="Jam Pulang" name="jam_pulang">
        </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
      <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                      height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                      stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                      class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M12 10l0 3l2 0" />
                      <path d="M7 4l-2.75 2" />
                      <path d="M17 4l2.75 2" />
                    </svg>
          </span>
          <input type="text" value="" id="total_jam" class="form-control" 
          placeholder="Total Jam" name="total_jam">
        </div>
  </div>
</div>
<div class="row mb-3">
  <div class="col-12">
    <div class="form-group">
      <select name="status_istirahat" id="status_istirahat" class="form-select">
        <option value="">Istirahat</option>
        <option value="1">Ada</option>
        <option value="0">Tidak</option>
      </select>
    </div>
  </div>
</div>
<div class="row setjamistirahat">
  <div class="col-12">
      <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                    height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                    stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                    class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M12 10l0 3l2 0" />
                    <path d="M7 4l-2.75 2" />
                    <path d="M17 4l2.75 2" />
                  </svg>
          </span>
          <input type="text" value="" id="awal_jam_istirahat" class="form-control" 
          placeholder="Awal Jam Istirahat" name="awal_jam_istirahat">
        </div>
  </div>
</div>
<div class="row setjamistirahat">
  <div class="col-12">
      <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  
                    height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                    stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                    class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M12 10l0 3l2 0" />
                    <path d="M7 4l-2.75 2" />
                    <path d="M17 4l2.75 2" />
                  </svg>
          </span>
          <input type="text" value="" id="akhir_jam_istirahat" class="form-control" 
          placeholder="Akhir Jam Istirahat" name="akhir_jam_istirahat">
        </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="form-group">
      <select name="lintashari" id="lintashari" class="form-select">
        <option value="">Lintas Hari</option>
        <option value="1">Ya</option>
        <option value="0">Tidak</option>
      </select>
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
<div class="modal modal-blur fade" id="modal-editjk" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Jam Kerja</h5>
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

        function showsetjamistirahat(){
          var status_istirahat = $("#status_istirahat").val();
          if(status_istirahat=="1"){
            $(".setjamistirahat").show();
          }else{
            $(".setjamistirahat").hide();
          }
        }
        $("#status_istirahat").change(function(){
            showsetjamistirahat();
        });
        showsetjamistirahat();

        $("#awal_jam_masuk, #jam_masuk, #akhir_jam_masuk, #jam_pulang, #awal_jam_istirahat, #akhir_jam_istirahat").mask("00:00");
        $("#btnTambahJK").click(function(){
            $("#modal-inputjk").modal("show");
        });
        $("#frmJK").submit(function(){
            var kode_jam_kerja = $("#kode_jam_kerja").val();
            var nama_jam_kerja = $("#nama_jam_kerja").val();
            var awal_jam_masuk = $("#awal_jam_masuk").val();
            var jam_masuk = $("#jam_masuk").val();
            var akhir_jam_masuk = $("#akhir_jam_masuk").val();
            var awal_jam_istirahat = $("#awal_jam_istirahat").val();
            var akhir_jam_istirahat = $("#akhir_jam_istirahat").val();
            var status_istirahat = $("#status_istirahat").val();
            var jam_pulang = $("#jam_pulang").val();
            var total_jam = $("#total_jam").val();
            var lintashari = $("#lintashari").val();
            if(kode_jam_kerja==""){
                //alert('kode harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode jam kerja harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#kode_jam_kerja").focus();
                    });
                return false;
            }else if (nama_jam_kerja==""){
                //alert('nama harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama jam kerja harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#nama_jam_kerja").focus();
                    });
                return false;
            }else if (awal_jam_masuk==""){
                //alert('awal_jam_masuk harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Awal jam masuk harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#awal_jam_masuk").focus();
                    });
                return false;
            }else if (jam_masuk==""){
                //alert('jam_masuk harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jam masuk harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#jam_masuk").focus();
                    });
                return false;
            }else if (akhir_jam_masuk==""){
                //alert('akhir_jam_masuk harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Akhir jam masuk harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#akhir_jam_masuk").focus();
                    });
                return false;
              }else if (status_istirahat===""){
                //alert('status_istirahat harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Status istirahat harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#status_istirahat").focus();
                    });
                return false;
              }else if (awal_jam_istirahat=="" && status_istirahat=="1"){
                //alert('awal_jam_istirahat harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Awal jam istirahat harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#awal_jam_istirahat").focus();
                    });
                return false;
              }else if (akhir_jam_istirahat=="" && status_istirahat=="1"){
                //alert('akhir_jam_istirahat harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Akhir jam istirahat harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#akhir_jam_istirahat").focus();
                    });
                return false;    
            }else if (jam_pulang==""){
                //alert('jam_pulang harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jam pulang harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#jam_pulang").focus();
                    });
                  return false;
            }else if (total_jam==""){
                //alert('total jam harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Total Jam harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#total_jam").focus();
                    });
                  return false;
                }else if (lintashari==""){
                //alert('lintashari harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Lintas Hari harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#lintashari").focus();
                    });
                  return false;
            }
          });
        });

        $(function(){
            $(".edit").click(function(){
            var kode_jam_kerja = $(this).attr('kode_jam_kerja');
            $.ajax({
                type:'POST',
                url:'/konfigurasi/editjamkerja',
                cache:false,
                data:{
                    _token:"{{ csrf_token(); }}",
                    kode_jam_kerja:kode_jam_kerja
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editjk").modal("show");
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
    </script>
@endpush