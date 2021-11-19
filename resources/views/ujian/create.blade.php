@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'master'; $page = 'ujian'; @endphp -->
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Tambah Ujian</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('ujian.index') }}">
                                <i class="material-icons">library_books</i> Beranda Ujian   
                            </a>
                        </li>
                        <li class="active">
                            <i class="material-icons">library_books</i> Tambah Ujian
                        </li>
                    </ol>
                </div>
                <div class="body">
                    {!! Form::open(['url' => route('ujian.store'),
                        'method' => 'post','files' => 'true' ]) !!}
                        @include('ujian._form')
                    {!! Form::close() !!}
                </div>
                <div class="footer bg-indigo">
                <br>
            </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->
</div>
@endsection