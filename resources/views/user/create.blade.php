@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'master'; $page = 'user'; @endphp -->
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Tambah Data User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('user.index') }}">
                                <i class="material-icons">person</i> Beranda Data User     
                            </a>
                        </li>
                        <li class="active">
                            <i class="material-icons">person_add</i> Tambah Data User
                        </li>
                    </ol>
                </div>
                <div class="body">
                    {!! Form::open(['url' => route('user.store'),
                        'method' => 'post','files' => 'true' ]) !!}
                        @include('user._form')
                    {!! Form::close() !!}
                </div>
                <div class="footer bg-indigo">
                <br>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->
</div>
@endsection