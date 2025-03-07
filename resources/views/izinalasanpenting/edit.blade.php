@extends('layouts.presensi')

@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal{
        max-height: 430px !important
    }
    .datepicker-date-display{
        background-color: blue !important
    }

    #keterangan{
        height: 5rem !important;
    }

</style>
<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pagetitle">Edit Izin Alasan Penting</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class ="col">
            <form method="POST" action="/izinalasanpenting/{{ $dataizin->kode_izin }}/update" id="frmizin">
                @csrf
                    <div class="form-group">
                        <input type="text" id="tgl_izin_dari" value="{{ $dataizin->tgl_izin_dari }}"  autocomplete="off" name="tgl_izin_dari" class="form-control datepicker"  
                        placeholder="Dari">
                    </div>
                    <div class="form-group">
                        <input type="text" id="tgl_izin_sampai" value="{{ $dataizin->tgl_izin_sampai }}" autocomplete="off" name="tgl_izin_sampai" class="form-control datepicker"  
                        placeholder="Sampai">
                    </div>
                    <div class="form-group">
                        <input type="text" id="jml_hari" name="jml_hari" class="form-control" autocomplete="off" 
                        placeholder="Jumlah Hari" readonly>
                    </div>
                    <div class="form-group">
                        <select name="kode_izinpenting" id="kode_izinpenting" class="form-control selectmaterialize">
                            <option value="">Pilih kategori izin alasan penting</option>
                            @foreach ($masterizinpenting as $c)
                                <option {{ $dataizin->kode_izinpenting == $c->kode_izinpenting ? 'selected' : '' }} 
                                    value="{{ $c->kode_izinpenting }}">{{ $c->nama_izinpenting }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" id="keterangan" value="{{ $dataizin->keterangan }}" name="keterangan" class="form-control" autocomplete="off"
                        placeholder="Keterangan">
                    </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Update</button>
            </div>
        </form>
    </div>
@endsection

@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();
        $(document).ready(function() {
         $(".datepicker").datepicker({
        format: "yyyy-mm-dd"    
         });

         function loadjumlahhari(){
	        var dari = $("#tgl_izin_dari").val();
	        var sampai = $("#tgl_izin_sampai").val();
	        var date1 = new Date(dari);
	        var date2 = new Date(sampai);

	    //to calculate the time difference of two dates
	        var Difference_In_Time = date2.getTime() - date1.getTime();

	    //to calculate the no. of days between two dates
	        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

            if(dari =="" || sampai ==""){
                var jmlhari = 0;
            }else{
                var jmlhari =Difference_In_Days + 1;
            }
            
            //to display the final no.of days (result)
	        $("#jml_hari").val(jmlhari + " Hari");
        }
        loadjumlahhari();

        $("#tgl_izin_dari,#tgl_izin_sampai").change(function(e){
            loadjumlahhari();
        });


         
        // $("#tgl_izin").change(function(e){
        //    var tgl_izin = $(this).val();
        //    $.ajax({
        //        type:'POST',
        //        url:'/presensi/cekpengajuanizin',
        //        data:{
        //            _token:"{{ csrf_token() }}",
        //            tgl_izin:tgl_izin
        //        },
        //        cache:false,
        //        success:function(respond){
        //            if(respond==1){
        //                Swal.fire({
        //                title: 'Oops!',
        //                text: 'Anda sudah input pengajuan izin pada tanggal tersebut',
        //                icon: 'warning'
        //            }).then((result) => {
        //                $("#tgl_izin").val("");
        //                });
        //            }
        //        }
        //    });
        // });

         $("#frmizin").submit(function(){
            var tgl_izin_dari = $("#tgl_izin_dari").val();
            var tgl_izin_sampai = $("#tgl_izin_sampai").val();
            var keterangan = $("#keterangan").val();
            var kode_izinpenting = $("#kode_izinpenting").val();
            if(tgl_izin_dari=="" ||tgl_izin_sampai==""){
                Swal.fire({
                        title: 'Oops!',
                        text: 'Tanggal harus diisi',
                        icon: 'warning'
                    });
                return false;
            }else if(kode_izinpenting==""){
                Swal.fire({
                        title: 'Oops!',
                        text: 'Kategori izin alasan penting harus diisi',
                        icon: 'warning'
                    });
                return false;
            }else if(keterangan==""){
                Swal.fire({
                        title: 'Oops!',
                        text: 'Keterangan harus diisi',
                        icon: 'warning'
                    });
                return false;
            }
         });
    }); 
</script>
    
@endpush