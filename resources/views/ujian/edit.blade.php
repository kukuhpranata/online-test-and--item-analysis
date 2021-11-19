@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'ujian'; $page = 'ujian'; @endphp -->
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Edit Data Ujian</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('ujian.index') }}">
                                <i class="material-icons">library_books</i> Beranda Ujian   
                            </a>
                        </li>
                        <li class="active">
                            <i class="material-icons">library_books</i> Edit Data Ujian
                        </li>
                    </ol>
                </div>
                <div class="body">
                    {!! Form::model($ujian, ['url' => route('ujian.update',$ujian->id),
                        'method' => 'put']) !!}
                        @include('ujian._form')
                        <div class="modal-footer">
                            <div class="row">
                                <button type="submit" class="btn btn-link waves-effect">SAVE</button>  
                            </div>
                        </div>
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