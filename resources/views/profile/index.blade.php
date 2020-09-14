@extends('layout/main')

@section('title', 'My Profile | To-do Web App')
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
                <a href="/changepassword">
                    <button type="button" class="btn btn-info float-right">Change Password</button>
                </a>
            </div>
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif

                <form method="POST" action="/profile/update">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control" name="email" id="email" value="{{ $user->email }}">
                            <small class="form-text" style="color: red;">*Cannot change email address</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Update My Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection