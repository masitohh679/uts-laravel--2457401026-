@extends('layouts.app')

@section('title', 'Form tambah data')

@section('content')
    <div class="page-heading">
        <a class="back-link" href="{{ route('siswa.index') }}">← Kembali ke daftar</a>
        <span class="eyebrow">DATA SISWA · INPUT BARU</span>
        <h1>{{ $errors->any() ? 'Form tambah data yang menampilkan pesan error validasi' : 'Form tambah data' }}</h1>
        <p>Masukkan informasi siswa baru pada formulir berikut.</p>
    </div>

    <form class="student-form" action="{{ route('siswa.store') }}" method="POST">
        @csrf
        @include('students._form')
    </form>
@endsection
