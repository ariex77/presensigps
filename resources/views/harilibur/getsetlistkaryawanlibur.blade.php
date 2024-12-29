@foreach ($karyawan as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->jabatan }}</td>
        <td>
            @if (!empty($d->ceknik))
            <a href="#" class="btn btn-danger btn-sm removekaryawan" nik="{{ $d->nik }}">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-square-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 2h-14a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3zm-9.387 6.21l.094 .083l2.293 2.292l2.293 -2.292a1 1 0 0 1 1.497 1.32l-.083 .094l-2.292 2.293l2.292 2.293a1 1 0 0 1 -1.32 1.497l-.094 -.083l-2.293 -2.292l-2.293 2.292a1 1 0 0 1 -1.497 -1.32l.083 -.094l2.292 -2.293l-2.292 -2.293a1 1 0 0 1 1.32 -1.497z" /></svg>
            </a>
            @else  
              <a href="#" class="btn btn-success btn-sm tambahkaryawan" nik="{{ $d->nik }}">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> 
            </a>
            @endif
        </td>
    </tr>
@endforeach

<script>
    $(function(){
        function loadsetlistkaryawanlibur(){
            var kode_libur = "{{ $kode_libur }}";
            $("#loadsetlistkaryawanlibur").load('/konfigurasi/harilibur/'+kode_libur+'/getsetlistkaryawanlibur');
        }
            function loadkaryawanlibur(){
            var kode_libur = "{{ $kode_libur }}"
            $("#loadkaryawanlibur").load('/konfigurasi/harilibur/'+kode_libur+'/getkaryawanlibur');
        }
        
        $(".tambahkaryawan").click(function(e){
                var kode_libur = "{{ $kode_libur }}";
                var nik = $(this).attr('nik');
                $.ajax({
                    type:'POST',
                    url:'/konfigurasi/harilibur/storekaryawanlibur',
                    data:{
                        _token:"{{ csrf_token() }}",
                        kode_libur:kode_libur,
                        nik:nik
                    },
                cache:false,
                success:function(respond){
                    if(respond=='0'){
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan!',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                            })
                            loadsetlistkaryawanlibur();
                            loadkaryawanlibur();
                    }else if(respond=='1'){
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Data sudah ada!',
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                            })
                        }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'respond',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                }
            });  
        }); 
        $(".removekaryawan").click(function(e){
                var kode_libur = "{{ $kode_libur }}";
                var nik = $(this).attr('nik');
                $.ajax({
                    type:'POST',
                    url:'/konfigurasi/harilibur/removekaryawanlibur',
                    data:{
                        _token:"{{ csrf_token() }}",
                        kode_libur:kode_libur,
                        nik:nik
                    },
                cache:false,
                success:function(respond){
                    if(respond=='0'){
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus!',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                            })
                            loadsetlistkaryawanlibur();
                            loadkaryawanlibur();
                    }else if(respond=='1'){
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Data sudah ada!',
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                            })
                        }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'respond',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                }
            });  
        }); 
    }); 
</script>