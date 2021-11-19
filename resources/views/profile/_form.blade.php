<div class="form-group form-float{{ $errors->has('new_password') ? 'has-error': '' }} ">
    {!! Form::label('new_password', 'Password Baru', ['class'=>'form-label']) !!}
    <div class="form-line">
        {!! Form::password('new_password', ['class'=>'form-control']) !!} 
    </div>
    {!! $errors->first('new_password', '<p class="error">:message</p>') !!}
</div>

<div class="form-group form-float{{ $errors->has('new_password_confirmation') ? 'has-error': '' }} ">
    {!! Form::label('new_password_confirmation', 'Konfirmasi password baru', ['class'=>'form-label']) !!}
    <div class="form-line">
        {!! Form::password('new_password_confirmation', ['class'=>'form-control']) !!} 
    </div>
    {!! $errors->first('new_password_confirmation', '<p class="error">:message</p>') !!}
</div>
