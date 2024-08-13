@extends('layouts.auth');

@section('title','Profile Post | Admin Dashbord');

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/multi-dropdown.css') }}">
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Masked Input -->
        <div class="card card-default">
            <div class="card-header">
                <h2>Update Profile</h2>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::has('alert-success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('alert-success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form method="POST" action="" enctype="">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" value="{{ old('name', $user ? $user->name : '') }}" class="form-control" placeholder="name">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email',  $user ? $user->email : '') }}" class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label>Password Confirm</label>
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Password Confirm">
                    </div>

                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
