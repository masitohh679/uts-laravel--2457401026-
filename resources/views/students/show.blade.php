@extends('layouts.app')

@section('title', 'Halaman detail data')

@section('content')
    <div class="page-heading">
        <a class="back-link" href="{{ route('siswa.index') }}">← Kembali ke daftar</a>
        <span class="eyebrow">DATA SISWA · PROFIL LENGKAP</span>
        <h1>Halaman detail data</h1>
        <p>Informasi lengkap siswa SMKN 1 Wirausaha.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="status"><span class="alert-symbol" aria-hidden="true">✓</span><span>{{ session('status') }}</span></div>
    @endif

    <section class="panel detail-panel">
        <div class="detail-profile">
            <div class="avatar">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
            <div>
                <span class="eyebrow">PROFIL SISWA</span>
                <h2>{{ $student->name }}</h2>
                <span class="student-nim">{{ $student->nim }}</span>
            </div>
            <span class="status-badge {{ $student->is_active ? 'status-active' : 'status-inactive' }}"><i></i>{{ $student->is_active ? 'Aktif' : 'Tidak aktif' }}</span>
        </div>

        <div class="detail-grid">
            <div class="detail-item"><span>Kelas</span><strong>{{ $student->classroom }}</strong></div>
            <div class="detail-item"><span>Tanggal lahir</span><strong>{{ $student->birth_date->translatedFormat('d F Y') }}</strong></div>
            <div class="detail-item"><span>Nilai rata-rata</span><strong>{{ number_format((float) $student->average_score, 2, ',', '.') }} <small>/ 100</small></strong></div>
            <div class="detail-item"><span>Telepon orang tua</span><strong>{{ $student->parent_phone ?: 'Belum diisi' }}</strong></div>
            <div class="detail-item detail-item-wide"><span>Alamat</span><strong>{{ $student->address ?: 'Belum diisi' }}</strong></div>
            <div class="detail-item"><span>Terdaftar sejak</span><strong>{{ $student->created_at->translatedFormat('d F Y') }}</strong></div>
        </div>

        <div class="detail-actions">
            <a class="button button-quiet" href="{{ route('siswa.index') }}">Kembali ke daftar</a>
            <a class="button button-outline" href="{{ route('siswa.confirm-destroy', $student) }}">Hapus data</a>
            <a class="button button-primary" href="{{ route('siswa.edit', $student) }}">Ubah data <span aria-hidden="true">→</span></a>
        </div>
    </section>
@endsection
