<form action="/konfigurasi/updatejamkerja" method="POST" id="frmJK_edit">
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
              <input type="text" id="kode_jam_kerja_edit" name="kode_jam_kerja" value="{{ $jamkerja->kode_jam_kerja }}" class="form-control" 
              placeholder="Kode Jam Kerja">
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
            <input type="text" value="{{ $jamkerja->nama_jam_kerja }}" id="nama_jam_kerja_edit"  class="form-control" 
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
          <input type="text" value="{{ $jamkerja->awal_jam_masuk }}" id="awal_jam_masuk_edit" class="form-control" 
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
        <input type="text" value="{{ $jamkerja->jam_masuk }}" id="jam_masuk_edit" class="form-control" 
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
      <input type="text" value="{{ $jamkerja->akhir_jam_masuk }}" id="akhir_jam_masuk_edit" class="form-control" 
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
    <input type="text" value="{{ $jamkerja->jam_pulang }}" id="jam_pulang_edit" class="form-control" 
    placeholder="Jam Pulang" name="jam_pulang">
  </div>
</div>
</div>
<div class="row">
  <div class="col-12">
    <div class="form-group">
      <select name="lintashari" id="lintashari" class="form-select">
        <option value="">Lintas Hari</option>
        <option value="1" {{ $jamkerja->lintashari==1 ? 'selected' : '' }}>Ya</option>
        <option value="0" {{ $jamkerja->lintashari==0 ? 'selected' : '' }}>Tidak</option>
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

    <script>
      $("#awal_jam_masuk_edit, #jam_masuk_edit, #akhir_jam_masuk_edit, #jam_pulang_edit").mask("00:00");
      $("#frmJK_edit").submit(function(){
            var kode_jam_kerja = $("#kode_jam_kerja_edit").val();
            var nama_jam_kerja = $("#nama_jam_kerja_edit").val();
            var awal_jam_masuk = $("#awal_jam_masuk_edit").val();
            var jam_masuk = $("#jam_masuk_edit").val();
            var akhir_jam_masuk = $("#akhir_jam_masuk_edit").val();
            var jam_pulang = $("#jam_pulang_edit").val();
            var lintashari = $("#lintashari_edit").val();
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
    </script>