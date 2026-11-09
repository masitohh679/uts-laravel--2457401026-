@extends('layouts.app')

@section('title', 'Konfirmasi sebelum menghapus data')

@section('content')
    <div class="page-heading">
        <a class="back-link" href="{{ route('siswa.show', $student) }}">← Kembali ke detail</a>
        <span class="eyebrow">DATA SISWA · KONFIRMASI</span>
        <h1>Konfirmasi sebelum menghapus data</h1>
        <p>Pastikan data yang dipilih sudah benar sebelum melanjutkan.</p>
    </div>

    <section class="panel confirm-panel">
        <div class="confirm-icon" aria-hidden="true">!</div>
        <span class="eyebrow">TINDAKAN INI TIDAK DAPAT DIBATALKAN</span>
        <h2>Hapus data siswa ini?</h2>
        <p>Data <strong>{{ $student->name }}</strong> (NIM {{ $student->nim }}) akan dihapus secara permanen dari daftar siswa.</p>
        <div class="confirm-summary">
            <span>{{ $student->classroom }}</span>
            <span>Nilai {{ number_format((float) $student->average_score, 2, ',', '.') }}</span>
        </div>
        <div class="confirm-actions">
            <a class="button button-quiet" href="{{ route('siswa.show', $student) }}">Jangan hapus</a>
            <form action="{{ route('siswa.destroy', $student) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="button button-danger" type="submit">Ya, hapus data</button>
            </form>
        </div>
    </section>
@endsection
