@extends('adminbsb.main')

@section('content')
@php $group = 'home'; $page = 'home'; @endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
               {{--<div class="header">
               <h2 align="center">
                        <i class="material-icons">train</i>
                    </h2>

                </div>--}}
                <div>
                <div class="body">
                    <div class="row clearfix">
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12;"> --}}
                            <div class="input-group input-group-lg">
                                <center>
                                <img src= {{ asset('/pen.png') }} width="110px">
                                </center>
                                <h1 align="center">SELAMAT DATANG</h1>
                                {{--<h4 align="center">Aplikasi Management Employee</h4>--}}
                                <h4 align="center">Sistem Informasi Ujian Daring</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer bg-indigo">
                <br>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->role_id == 2)
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Ujian Yang Tersedia
                    </h2>
                </div>
                <div>
                <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="table-responsive">
                                    {!! $dataTable->table(['class' => 'table-striped', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                </div>
                <div class="footer bg-indigo">
                <br>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

{{-- <script type="text/javascript">
    setTimeout(function(){
        location.reload();
    },10000);
 </script> --}}
@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection