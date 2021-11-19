@extends('adminbsb.main')

@section('content')
@php $group = 'home'; $page = 'profile'; @endphp
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="header">
                    <center><h2 class="font-bold">User Profile</h2></center>
                </div>
                <div class="body">
                        @include('profile.data')
                        <p><a class="btn bg-green waves-effect" href="{{ route('profile.edit') }}"> <i class="material-icons">person_add</i> <span><b>Ubah Password</b></span></a> </p>
                </div>
                <div class="footer bg-indigo">
                <br>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->
</div>
@endsection
