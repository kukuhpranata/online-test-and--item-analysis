@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'master'; $page = 'user'; @endphp -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                   
                    <h2>
                        Beranda Data User
                    </h2>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="material-icons">person</i> Beranda Data User
                        </li>
                    </ol>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p><a class="btn bg-green waves-effect" data-toggle="modal" data-target="#defaultModal"> <i class="material-icons">person_add</i> <span><b>Tambah User</b></span></a> </p>
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

<!--modals-->
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h2 class="modal-title" id="largeModalLabel">TAMBAH USER</h2>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => route('user.store'), 'method' => 'post','files' => 'true' ]) !!}
                @include('user._form')
                <div class="modal-footer">
                    <div class="row">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="submit" class="btn btn-link waves-effect" >SAVE</button>  
                    </div>
                </div>
            {!! Form::close() !!}
            
         </div>
        </div>
    </div>
</div>

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection