@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'master'; $page = 'ujian'; @endphp -->
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
                            <i class="material-icons">library_books</i> Edit Pertanyaan
                        </li>
                    </ol>
                </div>
                <div class="body">
                    {!! Form::model($pertanyaan, ['url' => route('pertanyaan.update',$pertanyaan->id),
                        'method' => 'put']) !!}
                        @include('pertanyaan._form')
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