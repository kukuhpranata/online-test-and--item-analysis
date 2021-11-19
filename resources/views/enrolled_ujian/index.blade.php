@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'master'; $page = 'ujian'; @endphp -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Ujian Yang Terdaftar
                    </h2>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="material-icons">library_books</i> Beranda Ujian Yang Terdaftar
                        </li>
                    </ol>
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


@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection