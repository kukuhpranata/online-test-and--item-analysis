@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'ujian'; $page = 'ujian'; @endphp -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Analsisis Butir Soal Ujian
                    </h2>
                </div>

                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <center>
                                    <h2>
                                        <strong>{!! $ujian->judul !!}</strong>
                                    </h2></center>
                                </div>
                                <div class="body">
                                    <dl class="dl-horizontal dl-small m-b-0 font-14">
                                        <dt>Pembuat Ujian :</dt>
                                        <dd>{!! $ujian->user->email !!}</dd><br>
        
                                        <dt>Tanggal Ujian  :</dt>
                                        <dd>{!! $ujian->tgl_ujian !!}</dd><br>
        
                                        <dt>Durasi :</dt>
                                        <dd>{!! $ujian->durasi !!} Menit</dd><br>
        
                                        <dt>Jumlah Soal :</dt>
                                        <dd>{!! $ujian->jumlah_soal !!}</dd><br>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table-striped', 'width' => '100%']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <center>
                                    <h2>
                                        Nilai Keandalan Kuder-Richardson 20 <small>Digunakan ketika <strong>tidak dapat</strong> dipastikan bahwa setiap item soal memiliki tingkat kesulitan yang sama</small>
                                    </h2></center>
                                </div>
                                <div class="body">
                                    <center> <h4>{!! $ujian->nilai_keandalan_kr20 !!}</h4>
                                        <br><h5>{!! $rely21 !!}</h5></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <center>
                                    <h2>
                                        Nilai Keandalan Kuder-Richardson 21 <small>Digunakan ketika <strong>dapat</strong> dipastikan bahwa setiap item soal memiliki tingkat kesulitan yang sama</small>
                                    </h2></center>
                                </div>
                                <div class="body">
                                    <center> <h4>{!! $ujian->nilai_keandalan_kr21 !!}</h4>
                                    <br><h5>{!! $rely21 !!}</h5></center>
                                </div>
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
</div>
@endsection


@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection