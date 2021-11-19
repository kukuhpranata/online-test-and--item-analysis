@if(Auth::user()->image != NULL)
    <center><img src="{{ asset('/storage/banner.jpg') }}" class="img-responsive" alt="Responsive Image" width="1500"></center><br>
@endif
@if(Auth::user()->image == NULL)
<center><div class="image">
        <img src="{{ asset('adminbsb/images/user.png') }}" width="48" height="48" alt="User" />
    </div></center>
@endif
<div class="form-group form-float{{ $errors->has('nama') ? 'has-error': '' }} ">
    {!! Form::label('nama', 'Nama', ['class'=>'form-label']) !!}
    <div class="form-line">
        {!! $user->nama !!} 
    </div>
    {!! $errors->first('nama', '<p class="error">:message</p>') !!}
</div>


<div class="form-group form-float{{ $errors->has('email') ? 'has-error': '' }} ">
    {!! Form::label('email', 'Email', ['class'=>'form-label']) !!}
    <div class="form-line">
        {!! $user->email !!} 
    </div>
    {!! $errors->first('email', '<p class="error">:message</p>') !!}
</div>

<div align = 'right'>
    {!! Form::submit ('Ubah Password',['class'=>'btn btn-primary waves-effect']) !!}
</div>