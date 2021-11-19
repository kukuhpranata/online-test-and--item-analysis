{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}

 <!DOCTYPE html>
<html>

<head>
<style>
</style>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Ujian Online</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('/pen.png')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('adminbsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('adminbsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('adminbsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('adminbsb/css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="filter"></div>
        <div class="login-box" style="z-index: 2;">
            <div class="logo">
                <a href="{{ url('/') }}"><b>SISTEM INFORMASI <br> UJIAN DARING</b></a>
            </div>
            <div class="card">
                <div class="body">
                    {!! Form::open(['url' => route('login'),
                        'method' => 'post' , 'id' => 'sign_in']) !!}
                    {{-- <form id="sign_in" method="POST"> --}}
                      {{--   <center>
                        <img src="https://www.inka.co.id/assets/logo/logo-md.png" width="100px">
                        </center>
                        <div class="msg">PT INDUSTRI KERETA API (Persero)</div>--}}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_box</i>
                            </span>
                            <div class="form-line">
                                {!! Form::text('email', null, ['class'=>'form-control', 'placeholder' => 'email', 'id'=> 'email', 'required']) !!} 
                            </div>
                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        {{-- <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                            </div>
                        </div> --}}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'password', 'id'=>'password', 'required']) !!} 
                            </div>
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        {{-- <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div> --}}
                        <div class="row">
                            {{--<div class="col-xs-8 p-t-5">--}}
                            {{--<div>--}}

                            <div class="align-center">
                                {{-- <button class="btn btn-lg bg-pink waves-effect'" type="submit">SIGN IN</button> --}}
                                {!! Form::submit ('SIGN IN',['type' => 'submit', 'class'=>'btn btn-block btn-lg bg-indigo waves-effect']) !!} 
                            </div> <br>
                            <div class="align-center">
                                <div class="col-sm-6">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    <br>
                                </div>
                                <div class="col-sm-1">
                                    <h5>OR</h5>
                                </div>
                                <div class="col-sm-5">
                                    <a class="btn btn-link" href="{{ route('register.form') }}">
                                            Sign Up Here
                                    </a>
                                    <br>
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                        {{-- <div class="row m-t-15 m-b--20">
                            <div class="col-xs-6">
                                <a href="sign-up.html">Register Now!</a>
                            </div>
                            <div class="col-xs-6 align-right">
                                <a href="forgot-password.html">Forgot Password?</a>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
        {{--<button class="btn btn-warning">COBA BACKGROUND</button>--}}
    
    <!-- Jquery Core Js -->
    <script src="{{ asset('adminbsb/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('adminbsb/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('adminbsb/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    {{-- <script src="../../plugins/jquery-validation/jquery.validate.js"></script> --}}

    <!-- Custom Js -->
    <script src="{{ asset('adminbsb/js/admin.js') }}"></script>
    <script src="{{ asset('adminbsb/js/pages/index.js') }}"></script>
</body>

</html>