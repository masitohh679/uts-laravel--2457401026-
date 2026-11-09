@extends('layouts.app')

@section('title', 'Halaman Beranda')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <span class="eyebrow"><span class="eyebrow-line"></span> PORTAL SEKOLAH</span>
            <h1>Halaman Beranda</h1>
            <p class="hero-lead">Selamat datang di sistem informasi siswa <strong>SMKN 1 Wirausaha</strong>.</p>
            <p class="hero-description">Kelola data siswa dengan mudah — lihat daftar, tambah informasi baru, dan perbarui catatan akademik dalam satu tempat.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="{{ route('siswa.index') }}">
                    Lihat daftar siswa <span aria-hidden="true">→</span>
                </a>
                <a class="button button-quiet" href="{{ route('siswa.create') }}">Tambah data siswa</a>
            </div>
            <div class="hero-signature">
                <span class="signature-rule"></span>
                <span>Administrasi sekolah yang tertata, untuk masa depan yang lebih baik.</span>
            </div>
        </div>
        <div class="hero-art" aria-hidden="true">
            <div class="art-sun"></div>
            <div class="art-hill art-hill-back"></div>
            <div class="art-hill art-hill-front"></div>
            <div class="school-building">
                <div class="building-roof"></div>
                <div class="building-body">
                    <div class="building-sign">SMKN 1</div>
                    <div class="building-windows"><i></i><i></i><i></i><i></i></div>
                    <div class="building-door"></div>
                </div>
                <div class="building-base"></div>
            </div>
            <div class="art-cloud cloud-one"></div>
            <div class="art-cloud cloud-two"></div>
            <span class="art-caption">Sekolah · Berkarya · Berdaya</span>
        </div>
    </section>

    <section class="stats-grid" aria-label="Ringkasan data siswa">
        <article class="stat-card">
            <span class="stat-icon icon-blue">01</span>
            <div><span class="stat-label">Total siswa</span><strong class="stat-value">{{ $studentCount }}</strong></div>
            <span class="stat-note">terdaftar</span>
        </article>
        <article class="stat-card">
            <span class="stat-icon icon-green">✓</span>
            <div><span class="stat-label">Siswa aktif</span><strong class="stat-value">{{ $activeStudentCount }}</strong></div>
            <span class="stat-note">tahun ajaran ini</span>
        </article>
        <article class="stat-card stat-card-profile">
            <span class="stat-icon icon-gold">✦</span>
            <div><span class="stat-label">Identitas peserta</span><strong class="stat-value stat-profile-value">2457401026</strong></div>
            <span class="stat-note">digit kasus: 6</span>
        </article>
    </section>

    <section class="home-bottom">
        <div class="section-intro">
            <span class="eyebrow">MULAI DARI SINI</span>
            <h2>Semua data dalam genggaman.</h2>
        </div>
        <div class="quick-links">
            <a class="quick-link" href="{{ route('siswa.index') }}">
                <span class="quick-number">01</span>
                <span><strong>Daftar siswa</strong><small>Telusuri seluruh data siswa</small></span>
                <span class="quick-arrow" aria-hidden="true">↗</span>
            </a>
            <a class="quick-link" href="{{ route('siswa.create') }}">
                <span class="quick-number">02</span>
                <span><strong>Tambah data</strong><small>Catat siswa baru ke dalam sistem</small></span>
                <span class="quick-arrow" aria-hidden="true">↗</span>
            </a>
        </div>
    </section>
@endsection
