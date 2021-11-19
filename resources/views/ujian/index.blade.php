@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'ujian'; $page = 'ujian'; @endphp -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Beranda Ujian
                    </h2>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="material-icons">library_books</i> Beranda Ujian
                        </li>
                    </ol>
                </div>

                <div class="body">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            @if(Auth::user()->role_id == 1)
                            <p><a class="btn bg-green waves-effect" data-toggle="modal" data-target="#defaultModal"> <i class="material-icons">person_add</i> <span><b>Tambah Ujian</b></span></a> </p>
                            @endif
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



<!--modals-->
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h2 class="modal-title" id="largeModalLabel">TAMBAH UJIAN</h2>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => route('ujian.store'), 'method' => 'post','files' => 'true' ]) !!}
                @include('ujian._form')
                <div class="modal-footer">
                    <div class="row">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="submit" class="btn btn-link waves-effect">SAVE</button>  
                    </div>
                </div>
            {!! Form::close() !!}

         </div>
        </div>
    </div>
</div>






<!-- TinyMCE -->
<script src="{{ asset('adminbsb/plugins/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
    selector: 'textarea',  // note the comma at the end of the line!
    theme: "modern",
    height: 500,
    plugins: "image imagetools fullscreen code colorpicker textcolor wordcount link print table pagebreak preview hr ",
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | forecolor backcolor | preview print",
    });


</script>

<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endsection


@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection