@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">

        <h3 class="mb-4 text-center">📝 Ro‘yxatdan o‘tish</h3>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Ism</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Parol</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Parolni tasdiqlang</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-success w-100">Ro‘yxatdan o‘tish</button>
        </form>

        <p class="text-center mt-3">
            Akkauntingiz bormi?
            <a href="{{ route('login') }}">Kirish</a>
        </p>

    </div>
</div>

@endsection
