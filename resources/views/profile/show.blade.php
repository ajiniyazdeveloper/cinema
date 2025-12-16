@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 bg-dark text-light rounded-4 p-4">

                {{-- Profil sarlavhasi --}}
                <h3 class="mb-4">👤 Mening profilim</h3>

            

                {{-- Profil ma’lumotlari --}}
                <p><strong>Ism:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                {{-- Tahrirlash va parol o‘zgartirish --}}
                <div class="d-flex gap-2 mt-4 flex-wrap">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary fw-bold">
                        ✏️ Profilni tahrirlash
                    </a>
                    <button class="btn btn-warning fw-bold" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#changePassword" aria-expanded="false">
                        🔑 Parolni o‘zgartirish
                    </button>
                </div>

                {{-- Parolni o‘zgartirish collapse --}}
                <div class="collapse mt-3" id="changePassword">
                    <div class="card card-body bg-secondary text-light border-0 shadow-sm">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Yangi parol</label>
                                <input type="password" name="password" class="form-control" placeholder="Yangi parol">
                            </div>

                            <div class="mb-3">
                                <label>Parol tasdiqlash</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Parolni tasdiqlang">
                            </div>

                            <button class="btn btn-success fw-bold w-100">Saqlash</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
