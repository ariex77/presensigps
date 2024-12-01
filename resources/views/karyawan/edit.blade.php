<form action="/karyawan/{{ Crypt::encrypt($karyawan->nik) }}/update" method="POST" id="frmEditkaryawan" enctype="multipart/form-data">
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
                <input type="text" value="{{ $karyawan->nik }}" id="nik" class="form-control" placeholder="NIK" name="nik_baru">
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
                <input type="text" value="{{ $karyawan->nama_lengkap }}" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Karyawan">
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
                  class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                  <path d="M7 20l10 0" />
                  <path d="M9 16l0 4" />
                  <path d="M15 16l0 4" />
                  <path d="M8 12l3 -3l2 2l3 -3" />
                </svg>
                </span>
                <input type="text" value="{{ $karyawan->jabatan }}" id="jabatan" class="form-control" name="jabatan" placeholder="Jabatan">
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
                  fill="none"  stroke="currentColor"  
                  stroke-width="2"  stroke-linecap="round"  
                  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>
                </span>
                <input type="text" value="{{ $karyawan->no_hp }}" id="no_hp" class="form-control" name="no_hp" placeholder="No. HP">
              </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
                <input type="file" name="foto" class="form-control">
                <input type="hidden" name="old_foto" value="{{ $karyawan->foto }}">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
                <select name="kode_dept" id="kode_dept" class="form-select">
                    <option value="">Bidang</option>
                    @foreach ($departemen as $d)
                        <option {{ $karyawan->kode_dept == $d->kode_dept ? 'selected' :'' }} 
                            value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
                <select name="kode_cabang" id="kode_cabang" class="form-select">
                    <option value="">Kantor</option>
                    @foreach ($cabang as $d)
                        <option {{ $karyawan->kode_cabang == $d->kode_cabang ? 'selected' :'' }}
                            value="{{ $d->kode_cabang }}">{{ $d->nama_cabang }}</option>
                    @endforeach
                </select>
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

<script>
    $("#frmEditkaryawan").submit(function(){
            var nik = $("#frmEditkaryawan").find("#nik").val();
            var nama_lengkap = $("#frmEditkaryawan").find("#nama_lengkap").val();
            var jabatan = $("#frmEditkaryawan").find("#jabatan").val();
            var no_hp = $("#frmEditkaryawan").find("#no_hp").val();
            var kode_dept = $("#frmEditkaryawan").find("#kode_dept").val();
            var kode_cabang = $("#frmEditkaryawan").find("#kode_cabang").val();
            if(nik==""){
                //alert('NIK harus diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'NIK harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#nik").focus();
                    });
                return false;
            }else if(nama_lengkap==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#nama_lengkap").focus();
                    });
                return false;
            }else if(jabatan==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jabatan harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#jabatan").focus();
                    });
                return false;
            }else if(no_hp==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'No. HP harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#no_hp").focus();
                    });
                return false;
            }else if(kode_dept==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Bidang harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#kode_dept").focus();
                    });
                return false;
            }else if(kode_cabang==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kantor harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    }).then((result)=>{
                        $("#kode_cabang").focus();
                    });
                return false;
            }
        });
</script>