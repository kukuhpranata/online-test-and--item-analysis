<div class="modal-body">
    <div class="row">
        <div class="col-sm-8">
                <div class="form-group form-float{{ $errors->has('email') ? 'has-error': '' }} ">
                    {!! Form::label('email', 'Email', ['class'=>'form-label']) !!}
                    <div class="form-line">
                        {!! Form::text('email', null, ['class'=>'form-control', 'required']) !!} 
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        <div class="col-sm-8">
                <div class="form-group form-float{{ $errors->has('nama') ? 'has-error': '' }} ">
                    {!! Form::label('nama', 'Nama', ['class'=>'form-label']) !!}
                    <div class="form-line">
                        {!! Form::text('nama', null, ['class'=>'form-control', 'required']) !!} 
                    </div>
                    @if ($errors->has('nama'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        <div class="col-sm-8">
            <div class="form-group form-float{{ $errors->has('email') ? 'has-error': '' }} ">
                {!! Form::label('password', 'Password', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::password('password', ['class'=>'form-control', 'required']) !!} 
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group form-float{{ $errors->has('role_id') ? 'has-error': '' }} ">
                {!! Form::label('role_id', 'User Role', ['class'=>'form-label']) !!}
                {!! Form::select('role_id', ['' => '']+App\Role::pluck('display_name','id')->all(), null, 
                [ 'class' => 'js-selectize', 'placeholder' => 'Pilih User Role', 'required' ]) !!}
                @if ($errors->has('role_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('role_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

        {{-- <div class="row">
            <div class="col-sm-5">
                <div class="form-group form-float{{ $errors->has('file') ? 'has-error': '' }} ">
                    {!! Form::label('file', 'Upload Foto', ['class'=>'form-label']) !!}
                    {!! Form::file('file', ['class'=>'form-control', 'required'] ); !!}
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div> --}}
</div>




<script src="{{ asset('adminbsb/plugins/jquery/jquery.min.js') }}"></script>



