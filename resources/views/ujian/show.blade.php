@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'laporan'; $page = 'laporan_monitoring'; @endphp -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Laporan Monitoring
                    </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('laporan_monitoring.index') }}">
                                <i class="material-icons">library_books</i> Beranda Laporan Monitoring
                            </a>
                        </li>
                        
                        <li class="active">
                            <i class="material-icons">library_books</i> Detail Laporan Monitoring
                        </li>
                    </ol>
                </div>

                <div class="body">
                    <div class="row">
                        @include('laporan_monitoring._show_detail_monitoring')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- {!! $dataTable->scripts() !!} --}}
@endsection