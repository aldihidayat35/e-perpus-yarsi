@extends('layouts.app')

@section('title', 'Detail Buku')
@section('page-title', 'Detail Buku')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.books.index') }}" class="text-muted text-hover-primary">Buku Fisik</a>
    </li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-gray-900">Detail</li>
</ul>
@endsection

@section('content')
<div class="row g-5 g-xl-8">
    <div class="col-xl-4">
        <div class="card mb-5 mb-xl-8">
            <div class="card-body pt-15">
                <div class="d-flex flex-center flex-column mb-5">
                    @if($book->cover_image)
                        <div class="mb-7">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="rounded" style="max-height: 250px; width: auto;"/>
                        </div>
                    @else
                        <div class="symbol symbol-150px mb-7">
                            <div class="symbol-label fs-1 fw-semibold bg-light-primary text-primary">
                                <i class="ki-duotone ki-book fs-3x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                    @endif
                    <span class="fs-3 text-gray-800 fw-bold mb-1">{{ $book->title }}</span>
                    <span class="fs-5 fw-semibold text-gray-500 mb-6">{{ $book->author }}</span>
                    <div class="d-flex flex-wrap flex-center">
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 me-3">
                            <div class="fs-4 fw-bold text-gray-700">
                                <span class="w-75px">{{ $book->stock }}</span>
                            </div>
                            <div class="fw-semibold text-muted">Stok</div>
                        </div>
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 me-3">
                            <div class="fs-4 fw-bold text-gray-700">
                                <span class="w-75px">{{ $book->loans->where('status', 'borrowed')->count() }}</span>
                            </div>
                            <div class="fw-semibold text-muted">Dipinjam</div>
                        </div>
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                            <div class="fs-4 fw-bold text-gray-700">
                                <span class="w-75px">{{ $book->loans->count() }}</span>
                            </div>
                            <div class="fw-semibold text-muted">Total Pinjam</div>
                        </div>
                    </div>
                </div>
                <div class="separator separator-dashed my-3"></div>
                <div class="mb-7">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-gray-600 fs-7">Kode/ISBN</span>
                        <span class="badge badge-light-info">{{ $book->code }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-gray-600 fs-7">Penerbit</span>
                        <span class="text-gray-800 fs-7">{{ $book->publisher ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-gray-600 fs-7">Tahun</span>
                        <span class="text-gray-800 fs-7">{{ $book->year ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-gray-600 fs-7">Kategori</span>
                        <span class="badge badge-light-primary">{{ $book->category->name }}</span>
                    </div>
                </div>
                <div class="d-flex flex-center">
                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-light-primary me-3">
                        <i class="ki-duotone ki-pencil fs-5"></i> Edit
                    </a>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-light">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        @if($book->description)
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0">
                <h3 class="card-title fw-bold text-gray-900">Deskripsi</h3>
            </div>
            <div class="card-body pt-0">
                <p class="text-gray-700 fs-6">{{ $book->description }}</p>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Riwayat Peminjaman</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">10 peminjaman terakhir</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-150px">Peminjam</th>
                                <th class="min-w-100px">Tanggal Pinjam</th>
                                <th class="min-w-100px">Jatuh Tempo</th>
                                <th class="min-w-80px">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($book->loans as $loan)
                            <tr>
                                <td>
                                    <span class="text-gray-900 fw-bold d-block fs-6">{{ $loan->borrower_name }}</span>
                                    <span class="text-muted fw-semibold d-block fs-7">{{ $loan->borrower_phone }}</span>
                                </td>
                                <td>{{ $loan->loan_date->format('d M Y') }}</td>
                                <td>{{ $loan->due_date->format('d M Y') }}</td>
                                <td>{!! $loan->status_badge !!}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-10">Belum ada riwayat peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
