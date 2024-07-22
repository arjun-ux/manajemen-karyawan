@extends('layouts.main')
@section('content')
<style>
    body {
        background-color: #ddeddf;
    }
    .card-outline{
        border-top: green solid 5px;
    }
</style>
<div class="container" style="padding-top: 100px">
    <div class="row justify-content-center py-3">
        <div class="col-md-4 col-sm-8 col-xl-3">
            @if (session('error'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            <div class="card card-outline">
                <div class="card-header text-center border-light bg-white p-0">
                    <img class="mt-4" src="{{ asset('img/log.png') }}" alt="" width="90px">
                    <p>LOGIN</p>
                </div>

                <div class="card-body text-center">
                    <form action="{{ route('doLogin') }}" method="post">
                        @csrf
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-11">
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="username" placeholder="Username" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="mt-2">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="mt-2">

                                    <button class="form-control" type="submit" style="background-color: green; color:#ddeddf;">Log In</button>
                                </div>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
