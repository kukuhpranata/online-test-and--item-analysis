@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'ujian'; $page = 'ujian'; @endphp -->
@if($ujian->status == 2 && $enrolled->status_kehadiran == 1)
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="header">
                                        <h2><center><strong>Judul Ujian</center></strong></h2>
                                    </div>
                                    <div class="body">
                                            <center><strong>{!! $ujian->judul !!}</center></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="header">
                                        <h2><center><strong>Nama Peserta</center></strong></h2>
                                    </div>
                                    <div class="body">
                                        <dl class="dl-horizontal dl-small m-b-0 font-14">
                                            <center><strong> {!! Auth::user()->nama !!} </strong></center>
                                            {{-- <dt>Email :</dt>
                                            <dd>{!! Auth::user()->email !!}</dd><br> --}}
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="header">
                                        <h2><center><strong> Sisa Waktu</center></strong></h2>
                                    </div>
                                    <div class="body">
                                        <center><h2 id="demo" style="margin-right:15px"></h2></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                            {!! Form::open(['url' => route('jawaban.store', [$ujian->id]),
                                'method' => 'post','files' => 'true' ]) !!}
                            @include('view_ujian.pagination')
                            {!! Form::close() !!}
                    </div>
                    <div class="footer bg-indigo">
                    <br>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date('{{ $waktu_refresh }}').getTime();
        
        // Update the count down every 1 second
        var x = setInterval(function() {
        
          // Get today's date and time
          var now = new Date().getTime();
            
          // Find the distance between now and the count down date
          var distance = countDownDate - now;
            
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
          // Output the result in an element with id="demo"
          document.getElementById("demo").innerHTML = days + "hari    " + hours + "jam    "
             + minutes + "menit    " + seconds + "detik ";
            
        //   // If the count down is over, write some text 
        //   if (minutes = 5){
         //    alert('Waktu Tersisa 5 Menit!');
        //   }

        if (distance < 300000 && distance >299000) {
            alert('Waktu Tersisa 5 Menit!');
          }
    
        //   if (distance < 0) {
        //     location.reload();
        //   }
        }, 1000);
    
    </script>
@endif
@if($ujian->status == 1)
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Judul Ujian</strong></center></h2>
                                </div>
                                <div class="body">
                                        <center><strong> {!! $ujian->judul !!}</center></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Nama Peserta</center></strong></h2>
                                </div>
                                <div class="body">
                                    <dl class="dl-horizontal dl-small m-b-0 font-14">
                                        <center><strong> {!! Auth::user()->nama !!}</center></strong>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Ujian Dimulai Dalam</center></strong> </h2>
                                </div>
                                <div class="body">
                                    <center><h2 id="demo" style="margin-right:15px"></h2></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12;"> --}}
                            <div class="input-group input-group-lg">
                                <h1 align="center">UJIAN Belum Dimulai</h1>
                                {{-- <h4 align="center">Aplikasi Management Employee</h4>
                                <h4 align="center">Hubungi Pengajar Jika Telat Mengerjakan</h4> --}}
                            </div>
                        </div>
                    </div>
                    <div class="footer bg-indigo">
                    <br>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Set the date we're counting down to
    var countDownDate = new Date('{{$ujian->tgl_ujian}}').getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = days + "hari    " + hours + "jam    "
      + minutes + "menit    " + seconds + "detik ";

      if (distance < 0) {
        document.getElementById("demo").innerHTML = "Ujian Dimulai, Refresh Halaman" ;
          }
        
    }, 1000);

</script>
@endif

@if($ujian->status == 2 && $enrolled->status_kehadiran == 2 )
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Judul Ujian</center></strong></h2>
                                </div>
                                <div class="body">
                                        <center><strong> {!! $ujian->judul !!}</center></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Nama Peserta</center></strong></h2>
                                </div>
                                <div class="body">
                                    <dl class="dl-horizontal dl-small m-b-0 font-14">
                                        <center><strong> {!! Auth::user()->nama !!}</center></strong>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Sisa Waktu</center></strong></h2>
                                </div>
                                <div class="body">
                                    <center><h2>-</h2></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12;"> --}}
                            <div class="input-group input-group-lg">
                                <h1 align="center">ANDA SUDAH MENGERJAKAN UJIAN</h1>
                            </div>
                        </div>
                    </div>
                    <div class="footer bg-indigo">
                    <br>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($ujian->status == 3)
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Judul Ujian</center></strong></h2>
                                </div>
                                <div class="body">
                                        <center><strong> {!! $ujian->judul !!}</center></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Nama Peserta</center></strong></h2>
                                </div>
                                <div class="body">
                                    <dl class="dl-horizontal dl-small m-b-0 font-14">
                                        <center><strong> {!! Auth::user()->nama !!}</center></strong>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h2><center><strong>Sisa Waktu</center></strong></h2>
                                </div>
                                <div class="body">
                                    <center><h2>-</h2></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12;"> --}}
                            <div class="input-group input-group-lg">
                                <h1 align="center">UJIAN TELAH SELESAI</h1>
                                {{--<h4 align="center">Aplikasi Management Employee</h4>--}}
                                <h4 align="center">Hubungi Pengajar Jika Telat Mengerjakan</h4>
                            </div>
                        </div>
                    </div>
                    <div class="footer bg-indigo">
                    <br>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection


{{-- <script type="text/javascript">
    setTimeout(function(){
        var status = 4;
        $.ajax({
            url:"{{route('statusujian.update', [$ujian->id])}}",  
            method:"PUT",  
            data:{
                status:status
            },                              
            success: function( data ) {
            }
        });
        location.reload();
    },2000);
 </script> --}}

