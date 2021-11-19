@extends('adminbsb.main')

@section('content')
<!-- @php $group = 'master'; $page = 'ujian'; @endphp -->
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Tambah Pertanyaan</h2>
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
                    {!! Form::open(['url' => route('pertanyaan.store', [$ujian->id]),
                        'method' => 'post','files' => 'true' ]) !!}
                        @include('pertanyaan._form')
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

<!-- TinyMCE -->
<script src="{{ asset('adminbsb/plugins/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
    selector: '#editor',  // note the comma at the end of the line!
    theme: "modern",
    height: 100,
    plugins: "image imagetools fullscreen code colorpicker textcolor wordcount link print table pagebreak preview hr ",
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | forecolor backcolor | preview print",
    });


</script>
@endsection