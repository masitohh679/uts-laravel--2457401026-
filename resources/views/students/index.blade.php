@extends('layouts.app')

@php
    $resultAction = session('resultAction');
    $heading = match ($resultAction) {
        'created' => 'Halaman daftar dengan pesan sukses setelah menambah data',
        'deleted' => 'Halaman daftar dengan pesan sukses setelah menghapus data',
        default => 'Halaman daftar data',
    };
@endphp

@section('title', $heading)

@section('content')
    <div class="page-heading heading-with-action">
        <div>
            <span class="eyebrow">DATA AKADEMIK · SMKN 1 WIRAUSAHA</span>
            <h1>{{ $heading }}</h1>
            <p>Kelola informasi siswa secara tertib dan terpusat.</p>
        </div>
        <a class="button button-primary" href="{{ route('siswa.create') }}"><span class="button-plus">+</span> Tambah data</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="status">
            <span class="alert-symbol" aria-hidden="true">✓</span>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <section class="panel table-panel">
        <div class="panel-heading">
            <div>
                <h2>Daftar siswa</h2>
                <p>{{ $students->total() }} data siswa terdaftar</p>
            </div>
            <span class="table-count">{{ str_pad((string) $students->total(), 2, '0', STR_PAD_LEFT) }} SISWA</span>
        </div>
        <div class="table-scroll">
            <table class="student-table">
                <thead>
                    <tr>
                        <th class="column-number">No.</th>
                        <th>NIM</th>
                        <th>Nama siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal lahir</th>
                        <th>Nilai rata-rata</th>
                        <th>Status</th>
                        <th class="column-actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td class="row-number">{{ str_pad((string) $students->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="student-nim">{{ $student->nim }}</td>
                            <td>
                                <span class="student-name">{{ $student->name }}</span>
                                <span class="student-subline">{{ $student->parent_phone ?: 'Nomor orang tua belum diisi' }}</span>
                            </td>
                            <td><span class="class-tag">{{ $student->classroom }}</span></td>
                            <td>{{ $student->birth_date->format('d M Y') }}</td>
                            <td><span class="score-value">{{ number_format((float) $student->average_score, 2, ',', '.') }}</span></td>
                            <td><span class="status-badge {{ $student->is_active ? 'status-active' : 'status-inactive' }}"><i></i>{{ $student->is_active ? 'Aktif' : 'Tidak aktif' }}</span></td>
                            <td>
                                <div class="table-actions">
                                    <a class="action-link action-view" href="{{ route('siswa.show', $student) }}" aria-label="Lihat {{ $student->name }}">Detail</a>
                                    <a class="action-link action-edit" href="{{ route('siswa.edit', $student) }}" aria-label="Ubah {{ $student->name }}">Ubah</a>
                                    <a class="action-link action-delete" href="{{ route('siswa.confirm-destroy', $student) }}" aria-label="Hapus {{ $student->name }}">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="empty-cell" colspan="8">
                                <span class="empty-mark">—</span>
                                <strong>Belum ada data siswa.</strong>
                                <span>Tambahkan data pertama untuk memulai.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($students->hasPages())
            <div class="pagination-wrap">{{ $students->links() }}</div>
        @endif
    </section>

    <p class="page-footnote"><span class="footnote-dot"></span> Data siswa dikelola khusus untuk SMKN 1 Wirausaha.</p>
@endsection
