@extends('layouts.template')
@section('content')
<style>
    /* Styling container profil */
    .profile-container {
        text-align: center;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;  /* Batas lebar maksimal container */
        width: 100%;
        margin: auto;  /* Mengatur agar container berada di tengah */
    }

    /* Styling gambar profil */
    .profile-container img {
        border-radius: 50%;
        width: 250px;
        height: 250px;
        object-fit: cover;
        margin-bottom: 20px;  /* Jarak bawah pada gambar */
    }

    /* Styling judul profil */
    .profile-container h3 {
        margin-top: 10px;
        font-size: 1.5rem;
        color: #333;
    }


    /* Styling input file */
    input[type="file"] {
        display: block;
        width: 100%;  /* Input file memenuhi lebar container */
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Styling list informasi profil */
    .list-group-item {
        border: none;
        padding: 10px 15px;
        font-size: 1rem;
    }

    /* Styling untuk tombol kembali */
    .btn-block {
        width: 100%;
    }

    .form-group {
        text-align: left;
    }


</style>

<div class="profile-container">
    <!-- Menampilkan gambar profil jika tersedia -->
    @php
        $profilePicture = null;

        if (file_exists(public_path('storage/uploads/profile_pictures/' . auth()->user()->username . '/' . auth()->user()->username . '_profile.png'))) {
            $profilePicture = asset('storage/uploads/profile_pictures/' . auth()->user()->username . '/' . auth()->user()->username . '_profile.png');
        } elseif (file_exists(public_path('storage/uploads/profile_pictures/' . auth()->user()->username . '/' . auth()->user()->username . '_profile.jpg'))) {
            $profilePicture = asset('storage/uploads/profile_pictures/' . auth()->user()->username . '/' . auth()->user()->username . '_profile.jpg');
        } elseif (file_exists(public_path('storage/uploads/profile_pictures/' . auth()->user()->username . '/' . auth()->user()->username . '_profile.jpeg'))) {
            $profilePicture = asset('storage/uploads/profile_pictures/' . auth()->user()->username . '/' . auth()->user()->username . '_profile.jpeg');
        }
    @endphp

    <!-- Default image jika gambar tidak ditemukan -->
    <img src="{{ $profilePicture ?? 'https://via.placeholder.com/250' }}" alt="User profile picture">

    <h3 class="profile-username">{{ auth()->user()->nama }}</h3>
    <p class="text-muted">{{ auth()->user()->level->level_nama }}</p>
    <hr>
    <!-- Form untuk upload gambar profil -->
    <form action="{{ url('update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" id="update" name="foto" accept="image/*">
        <br>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ url('/') }}" class="btn btn-secondary btn-block"><b>Kembali</b></a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection