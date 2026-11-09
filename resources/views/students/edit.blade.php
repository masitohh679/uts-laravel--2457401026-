@extends('layouts.app')

@section('title', 'Form ubah data')

@section('content')
    <div class="page-heading">
        <a class="back-link" href="{{ route('siswa.show', $student) }}">← Kembali ke detail</a>
        <span class="eyebrow">DATA SISWA · UBAH INFORMASI</span>
        <h1>Form ubah yang sudah terisi data lama</h1>
        <p>Perbarui informasi <strong>{{ $student->name }}</strong> dan simpan perubahan.</p>
    </div>

    <form class="student-form" action="{{ route('siswa.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        @include('students._form')
    </form>
@endsection
