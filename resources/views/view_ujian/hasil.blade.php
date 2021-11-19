@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'ujian'; $page = 'ujian'; @endphp -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Hasil Ujian
                    </h2>
                </div>

                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <center>
                                    <h2>
                                        Hasil Ujian <strong>{!! $enrollujian->ujian->judul !!}</strong> oleh <strong> {!! $enrollujian->user->nama !!}</strong>
                                    </h2></center>
                                </div>
                            </div>
                        </div>
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
</div>
@endsection


@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection





