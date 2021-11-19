@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'ujian'; $page = 'ujian_enrolled'; @endphp -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Ujian Yang Terdaftar
                    </h2>
                </div>

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
</div>
@endsection


@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection