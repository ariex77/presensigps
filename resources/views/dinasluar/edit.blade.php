<form action="/dinasluar/{{ $dinasluar->kode_dinasluar }}/update" method="POST" id="frmdinasluar">
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
                <input type="text" value="{{ $dinasluar->kode_dinasluar }}" id="kode_dinasluar" readonly class="form-control" 
                placeholder="Kode Dinas Luar" name="kode_dinasluar">
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
                <input type="text" value="{{ $dinasluar->nama_dinasluar }}" id="nama_dinasluar" class="form-control" 
                name="nama_dinasluar" placeholder="Nama Dinas Luar">
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
                <input type="text" value="{{ $dinasluar->jml_dinasluar }}" id="jml_dinasluar" class="form-control" 
                name="jml_dinasluar" placeholder="Jumlah Dinas Luar">
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
            Update
        </button>
        </div>
    </div>
</div>
</form>