<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group form-float{{ $errors->has('judul_edit') ? 'has-error': '' }} ">
                {!! Form::label('judul', 'Pertanyaan', ['class'=>'form-label']) !!}
                {!! Form::textarea('judul_edit', null, ['class'=>'form-control', 'novalidate' ]) !!} 
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group form-float{{ $errors->has('opsi1') ? 'has-error': '' }} ">
                {!! Form::label('opsi1', 'Opsi 1', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::text('opsi1', null, ['class'=>'form-control', 'required' ]) !!} 
                </div>
                @if ($errors->has('opsi1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('opsi1') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group form-float{{ $errors->has('opsi2') ? 'has-error': '' }} ">
                {!! Form::label('opsi2', 'Opsi 2', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::text('opsi2', null, ['class'=>'form-control', 'required' ]) !!} 
                </div>
                @if ($errors->has('opsi2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('opsi2') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group form-float{{ $errors->has('opsi3') ? 'has-error': '' }} ">
                {!! Form::label('opsi3', 'Opsi 3', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::text('opsi3', null, ['class'=>'form-control', 'required' ]) !!} 
                </div>
                @if ($errors->has('opsi3'))
                    <span class="help-block">
                        <strong>{{ $errors->first('opsi3') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group form-float{{ $errors->has('opsi4') ? 'has-error': '' }} ">
                {!! Form::label('opsi4', 'Opsi 4', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::text('opsi4', null, ['class'=>'form-control', 'required' ]) !!} 
                </div>
                @if ($errors->has('opsi4'))
                    <span class="help-block">
                        <strong>{{ $errors->first('opsi4') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group form-float{{ $errors->has('opsi5') ? 'has-error': '' }} ">
                {!! Form::label('opsi5', 'Opsi 5', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::text('opsi5', null, ['class'=>'form-control', 'required' ]) !!} 
                </div>
                @if ($errors->has('opsi5'))
                    <span class="help-block">
                        <strong>{{ $errors->first('opsi5') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group form-float{{ $errors->has('jawaban') ? 'has-error': '' }} ">
                {!! Form::label('jawaban', 'Jawaban', ['class'=>'form-label']) !!}
                    {!! Form::select('jawaban', ['1' => 'Opsi 1', '2' => 'Opsi 2', '3' => 'Opsi 3', '4' => 'Opsi 4', '5' => 'Opsi 5',],null,[ 'class' => 'js-selectize', 'placeholder' => 'Pilih', 'required' ]) !!} 
                    @if ($errors->has('jawaban'))
                        <span class="help-block">
                            <strong>{{ $errors->first('jawaban') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
    </div>
</div>


<!--
    <div class="col-sm-8">
            <div class="form-group form-float{{ $errors->has('opsi5') ? 'has-error': '' }} ">
                {!! Form::label('opsi5', 'Opsi 5', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::text('opsi5', null, ['class'=>'form-control', 'id' => 'opsi4', 'rows'=> '5']) !!}
                </div>
                {!! $errors->first('opsi5', '<p class="error">:message</p>') !!}
            </div>
        </div> -->