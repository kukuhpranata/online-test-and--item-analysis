
@foreach($pertanyaan as $pertanyaan)
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 class="card-inside-title">{!! $pertanyaan ->judul_soal !!}</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-float{{ $errors->has('opsi') ? 'has-error': '' }} ">
                            {!! Form::radio('opsi'.$pertanyaan->id, 1, '', ['class' => 'form-check-input', 'id' => 'id_opsi1'.$pertanyaan->id]) !!}
                            {!! Form::label('id_opsi1'.$pertanyaan->id,  $pertanyaan->opsi1, ['class' => 'form-check-label']) !!}
                            {!! $errors->first('opsi', '<p class="error">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-float{{ $errors->has('opsi') ? 'has-error': '' }} ">
                            {!! Form::radio('opsi'.$pertanyaan->id, 2, '', ['class' => 'form-check-input', 'id' => 'id_opsi2'.$pertanyaan->id]) !!}
                            {!! Form::label('id_opsi2'.$pertanyaan->id,  $pertanyaan->opsi2, ['class' => 'form-check-label']) !!}
                            {!! $errors->first('opsi', '<p class="error">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-float{{ $errors->has('opsi') ? 'has-error': '' }} ">
                            {!! Form::radio('opsi'.$pertanyaan->id, 3, '', ['class' => 'form-check-input', 'id' => 'id_opsi3'.$pertanyaan->id]) !!}
                            {!! Form::label('id_opsi3'.$pertanyaan->id,  $pertanyaan->opsi3, ['class' => 'form-check-label']) !!}
                            {!! $errors->first('opsi', '<p class="error">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-float{{ $errors->has('opsi') ? 'has-error': '' }} ">
                            {!! Form::radio('opsi'.$pertanyaan->id, 4, '', ['class' => 'form-check-input', 'id' => 'id_opsi4'.$pertanyaan->id]) !!}
                            {!! Form::label('id_opsi4'.$pertanyaan->id,  $pertanyaan->opsi4, ['class' => 'form-check-label']) !!}
                            {!! $errors->first('opsi', '<p class="error">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-float{{ $errors->has('opsi') ? 'has-error': '' }} ">
                            {!! Form::radio('opsi'.$pertanyaan->id, 5, '', ['class' => 'form-check-input', 'id' => 'id_opsi5'.$pertanyaan->id]) !!}
                            {!! Form::label('id_opsi5'.$pertanyaan->id,  $pertanyaan->opsi5, ['class' => 'form-check-label']) !!}
                            {!! $errors->first('opsi', '<p class="error">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@if(Auth::user()->role_id == 2)
    <div class="marg" style="display: inline;">
        <div style="float: right;">
            <button type="submit" class="btn btn-link waves-effect" onclick="return confirm('Yakin dengan Jawaban Anda?')">KIRIM JAWABAN</button>
        </div>
        <br>
        <br>
    </div>
@endif


<script src="{{ asset('adminbsb/plugins/jquery/jquery.min.js') }}"></script>



