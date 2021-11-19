@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'master'; $page = 'user'; @endphp -->
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Edit Data User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('user.index') }}">
                                <i class="material-icons">person</i> Beranda Data User    
                            </a>
                        </li>
                        <li class="active">
                            <i class="material-icons">person_pin</i> Edit Data User
                        </li>
                    </ol>
                </div>
                <div class="body">
                    {!! Form::model($user, ['url' => route('user.update', $user->id),
                        'method' => 'put']) !!}
                        @include('user._form')
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
    <!-- #END# Basic Validation -->
</div>
@endsection