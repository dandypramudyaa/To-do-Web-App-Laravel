@extends('layout/main')

@section('title', 'Change My Password | To-do Web App')
@php
    $nav = 'Profile';
@endphp

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user" style="margin-top: 10px;"></i> My Profile
                <a href="/profile">
                    <button type="button" class="btn btn-info float-right">My Profile</button>
                </a>
            </div>
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif

                <form method="POST" action="/changepassword/update">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <label for="old" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="old" id="old" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="new" id="new" placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="joindate" class="col-sm-2 col-form-label">Retype new password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="new1" name="new1" placeholder="New Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2 mt-4">
                            <button class="btn btn-primary" type="submit" name="profile">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection