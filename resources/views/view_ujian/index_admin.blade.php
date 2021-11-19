@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'ujian'; $page = 'ujian'; @endphp -->
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
                                    <center><h2>-</h2></center>
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
@endsection



