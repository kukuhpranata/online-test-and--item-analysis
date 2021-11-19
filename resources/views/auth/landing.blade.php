

 <!DOCTYPE html>
 <html>
 
 <head>
 <style>
 </style>
     <meta charset="UTF-8">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     <title>Sistem Informasi Ujian Daring</title>
     <!-- Favicon-->
     <link rel="icon" href="{{ asset('/pen.png')}}" type="image/x-icon">
 
     <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
 
     <!-- Bootstrap Core Css -->
     <link href="{{ asset('adminbsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
 
     <!-- Waves Effect Css -->
     <link href="{{ asset('adminbsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />
 
     <!-- Animation Css -->
     <link href="{{ asset('adminbsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />
 
     <!-- Custom Css -->
     <link href="{{ asset('adminbsb/css/style.css') }}" rel="stylesheet">
 </head>
 
 <body class="login-page">
     <div class="filter"></div>
         <div class="login-box" style="z-index: 2;">
             <div class="logo">
                 <center><img src="{{ asset('Logo Undip.png') }}" width="200"  alt="User" /></center>
                 <center>
                    <h2 class="col-white"><b>PERANCANGAN SISTEM INFORMASI UJIAN DARING <br> MENGGUNAKAN KERANGKA-KERJA LARAVEL<br> DENGAN  ANALISIS BUTIR DAN UJI KEANDALAN KUDER-RICHARDSON</b></h2>
                    <br>
                    <h3 class="col-white">TUGAS AKHIR <br><br> Oleh : <br> Kukuh Pranata Sugiarto <br> 21120117120007<h3>
                    <br>
                    <h3 class="col-white">DEPARTEMEN TEKNIK KOMPUTER<br>
                    FAKULTAS TEKNIK <br>
                    UNIVERSITAS DIPONEGORO</h3>
                         
                 </center>
                 <br>
                 <div class="align-center">
                     {!! Form::open(['url' => route('login'), 'method' => 'get','files' => 'true' ]) !!}
                     {!! Form::submit ('MENUJU SISTEM',['type' => 'submit', 'class'=>'btn btn-block btn-lg bg-indigo waves-effect']) !!}
                     {!! Form::close() !!} 
                 </div>
             </div>
         </div>
     </div>
         {{--<button class="btn btn-warning">COBA BACKGROUND</button>--}}
     
     <!-- Jquery Core Js -->
     <script src="{{ asset('adminbsb/plugins/jquery/jquery.min.js') }}"></script>
 
     <!-- Bootstrap Core Js -->
     <script src="{{ asset('adminbsb/plugins/bootstrap/js/bootstrap.js') }}"></script>
 
     <!-- Waves Effect Plugin Js -->
     <script src="{{ asset('adminbsb/plugins/node-waves/waves.js') }}"></script>
 
     <!-- Validation Plugin Js -->
     {{-- <script src="../../plugins/jquery-validation/jquery.validate.js"></script> --}}
 
     <!-- Custom Js -->
     <script src="{{ asset('adminbsb/js/admin.js') }}"></script>
     <script src="{{ asset('adminbsb/js/pages/index.js') }}"></script>
 </body>
 
 </html>