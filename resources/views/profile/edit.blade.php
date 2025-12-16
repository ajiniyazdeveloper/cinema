@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 bg-dark text-light rounded-4 p-4">

                {{-- Sarlavha --}}
                <h3 class="mb-4">✏️ Profilni tahrirlash</h3>

            
                {{-- Profil tahrirlash form --}}
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Ism --}}
                    <div class="mb-3">
                        <label>Ism</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                

                    {{-- Parol --}}
                    <div class="mb-3">
                        <label>Yangi parol <small class="text-muted">(agar o‘zgartirmoqchi bo‘lsangiz)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Yangi parol">
                    </div>

                    <div class="mb-3">
                        <label>Parol tasdiqlash</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Parolni tasdiqlang">
                    </div>

                    {{-- Saqlash tugmasi --}}
                    <button class="btn btn-success fw-bold w-100">Saqlash</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
