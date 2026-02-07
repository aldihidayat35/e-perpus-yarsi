@extends('layouts.app')

@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.loans.index') }}" class="text-muted text-hover-primary">Peminjaman</a>
    </li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-gray-900">Detail</li>
</ul>
@endsection

@section('content')
<div class="row g-5 g-xl-8">
    <div class="col-xl-6">
        <div class="card mb-5 mb-xl-8">
            <div class="card-header">
                <h3 class="card-title">Informasi Peminjam</h3>
                <div class="card-toolbar">
                    {!! $loan->status_badge !!}
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-5">
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Nama Peminjam</span>
                        <span class="fw-bold text-gray-800">{{ $loan->borrower_name }}</span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">No. Telepon</span>
                        <span class="fw-bold text-gray-800">{{ $loan->borrower_phone }}</span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Email</span>
                        <span class="text-gray-800">{{ $loan->borrower_email ?? '-' }}</span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">No. Identitas</span>
                        <span class="text-gray-800">{{ $loan->identity_number ?? '-' }}</span>
                    </div>
                    @if($loan->notes)
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Catatan</span>
                        <span class="text-gray-800">{{ $loan->notes }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card mb-5 mb-xl-8">
            <div class="card-header">
                <h3 class="card-title">Informasi Peminjaman</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-5">
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Buku</span>
                        <span class="fw-bold text-gray-800">{{ $loan->book->title ?? '-' }}</span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Kode Buku</span>
                        <span class="badge badge-light-info">{{ $loan->book->code ?? '-' }}</span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Tanggal Pinjam</span>
                        <span class="fw-bold text-gray-800">{{ $loan->loan_date->format('d M Y') }}</span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Jatuh Tempo</span>
                        <span class="fw-bold {{ $loan->isOverdue() ? 'text-danger' : 'text-gray-800' }}">
                            {{ $loan->due_date->format('d M Y') }}
                            @if($loan->isOverdue())
                                (Terlambat {{ $loan->due_date->diffInDays(now()) }} hari)
                            @endif
                        </span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Tanggal Kembali</span>
                        <span class="text-gray-800">{{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Durasi</span>
                        <span class="text-gray-800">{{ $loan->loan_date->diffInDays($loan->due_date) }} hari</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-3">
    @if($loan->status !== 'returned')
    <form action="{{ route('admin.loans.return', $loan) }}" method="POST">
        @csrf @method('PATCH')
        <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi pengembalian buku?')">
            <i class="ki-duotone ki-check fs-2"></i> Tandai Dikembalikan
        </button>
    </form>
    @endif
    <a href="{{ route('admin.loans.index') }}" class="btn btn-light">Kembali</a>
</div>
@endsection
