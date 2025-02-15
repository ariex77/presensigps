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
        <div class="pagetitle">Form Dinas Luar</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class ="col">
            <form method="POST" action="/izindinasluar/store" id="frmizin">
                @csrf
                    <div class="form-group">
                        <input type="text" id="tgl_izin_dari" autocomplete="off" name="tgl_izin_dari" class="form-control datepicker"  
                        placeholder="Dari">
                    </div>
                    <div class="form-group">
                        <input type="text" id="tgl_izin_sampai" autocomplete="off" name="tgl_izin_sampai" class="form-control datepicker"  
                        placeholder="Sampai">
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="jml_dinasluar" name="jml_dinasluar" class="form-control" autocomplete="off" 
                        placeholder="Jumlah Dinas Luar" readonly>
                        <p id="info_jml_dinasluar"></p>
                    </div>
                    <div class="form-group">
                        <select name="kode_dinasluar" id="kode_dinasluar" class="form-control selectmaterialize">
                            <option value="">Pilih kategori dinas luar</option>
                            @foreach ($masterdinasluar as $c)
                                <option value="{{ $c->kode_dinasluar }}">{{ $c->nama_dinasluar }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="max_dinasluar" name="max_dinasluar" class="form-control" autocomplete="off"
                        placeholder="Maksimal Dinas Luar" readonly>
                        <p id="info_max_dinasluar"></p>
                    </div>
                </div>
            <div class="form-group">
                <input type="text" id="keterangan" name="keterangan" class="form-control" autocomplete="off"
                        placeholder="Keterangan">
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Kirim</button>
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

         function loadjumlahdinasluar(){
	        var dari = $("#tgl_izin_dari").val();
	        var sampai = $("#tgl_izin_sampai").val();
	        var date1 = new Date(dari);
	        var date2 = new Date(sampai);

	    //to calculate the time difference of two dates
	        var Difference_In_Time = date2.getTime() - date1.getTime();

	    //to calculate the no. of days between two dates
	        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

            if(dari =="" || sampai ==""){
                var jmldinasluar = 0;
            }else{
                var jmldinasluar =Difference_In_Days + 1;
            }
            
            //to display the final no.of days (result)
	        $("#jml_dinasluar").val(jmldinasluar);
            $("#info_jml_dinasluar").html("<b>Jumlah dinas luar yg akan diambil adalah: "+jmldinasluar+ " hari</b>");
        }

        $("#tgl_izin_dari,#tgl_izin_sampai").change(function(e){
            loadjumlahdinasluar();
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
            var jml_dinasluar = $("#jml_dinasluar").val();
            var max_dinasluar = $("#max_dinasluar").val();
            var keterangan = $("#keterangan").val();
            var kode_dinasluar = $("#kode_dinasluar").val();
            if(tgl_izin_dari=="" ||tgl_izin_sampai==""){
                Swal.fire({
                        title: 'Oops!',
                        text: 'Tanggal harus diisi',
                        icon: 'warning'
                    });
                return false;
            }else if(kode_dinasluar==""){
                Swal.fire({
                        title: 'Oops!',
                        text: 'Kategori dinas luar harus diisi',
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
            }else if(parseInt(jml_dinasluar)>parseInt(max_dinasluar)){
                Swal.fire({
                        title: 'Oops!',
                        text: 'Jumlah dinas luar tidak boleh melebihi '+max_dinasluar+" hari",
                        icon: 'warning'
                    });
                return false;
            }
         });

         $("#kode_dinasluar").change(function(e){
            var kode_dinasluar = $(this).val();
            var tgl_izin_dari = $("tgl_izin_dari").val();
            if(tgl_izin_dari==""){
                Swal.fire({
                        title: 'Oops!',
                        text: 'Tanggal dinas luar harus diisi',
                        icon: 'warning'
                    });
                    $("#kode_dinasluar").val("");
            }else{
                $.ajax({
                url:'/izindinasluar/getmaxdinasluar',
                type:'POST',
                data:{
                    _token:"{{ csrf_token() }}",
                    kode_dinasluar:kode_dinasluar,
                    tgl_izin_dari:tgl_izin_dari
                },
                cache:false,
                success:function(respond){
                    $("#max_dinasluar").val(respond);
                    $("#info_max_dinasluar").html("<b>Maksimal dinas luar yg dapat diambil adalah: "+respond+ " hari</b>");
                }
            });
            }
         });
    }); 
</script>
    
@endpush