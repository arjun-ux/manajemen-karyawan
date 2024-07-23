@extends('layouts.main')
@section('content')
<div class="container-login">
    <form class="login-form" action="{{ route('doRegister') }}" method="post">
        @csrf
        <div class="title">REGISTER</div>
        <div class="form-group">
            <input type="text" id="inputNo" name="no_wa" required placeholder="NO WhatsApp">
        </div>
        <div class="form-group">
            <input type="text" id="inputName" name="nama_lengkap" required placeholder="Nama Lengkap">
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" required placeholder="Password">
        </div>
        <button type="submit">Daftar</button>
    </form>
</div>
@endsection
