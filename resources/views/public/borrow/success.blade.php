@extends('layouts.public')

@section('title', 'Peminjaman Berhasil')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body text-center py-15">
                <div class="mb-8">
                    <i class="ki-duotone ki-check-circle fs-5x text-success"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <h2 class="fw-bold text-gray-900 mb-3">Peminjaman Berhasil!</h2>
                <p class="text-muted fs-5 mb-10">Terima kasih, peminjaman Anda telah dicatat.</p>

                <div class="bg-light-primary rounded p-6 text-start mb-8">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-semibold text-gray-600">Buku</span>
                        <span class="fw-bold text-gray-900">{{ $loan->book->title }}</span>
                    </div>
                    <div class="separator separator-dashed my-3"></div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-semibold text-gray-600">Peminjam</span>
                        <span class="fw-bold text-gray-900">{{ $loan->borrower_name }}</span>
                    </div>
                    <div class="separator separator-dashed my-3"></div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-semibold text-gray-600">Telepon</span>
                        <span class="text-gray-800">{{ $loan->borrower_phone }}</span>
                    </div>
                    <div class="separator separator-dashed my-3"></div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-semibold text-gray-600">Tanggal Pinjam</span>
                        <span class="fw-bold text-gray-900">{{ $loan->loan_date->format('d M Y') }}</span>
                    </div>
                    <div class="separator separator-dashed my-3"></div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-semibold text-gray-600">Jatuh Tempo</span>
                        <span class="fw-bold text-danger">{{ $loan->due_date->format('d M Y') }}</span>
                    </div>
                    <div class="separator separator-dashed my-3"></div>
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold text-gray-600">Status</span>
                        {!! $loan->status_badge !!}
                    </div>
                </div>

                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-8">
                    <i class="ki-duotone ki-information-5 fs-2x text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <div class="text-start">
                        <h4 class="fw-bold text-gray-800 mb-1">Penting!</h4>
                        <p class="text-gray-700 mb-0 fs-7">
                            Harap kembalikan buku sebelum tanggal jatuh tempo
                            (<strong>{{ $loan->due_date->format('d M Y') }}</strong>).
                            Keterlambatan akan dicatat dalam sistem.
                        </p>
                    </div>
                </div>

                <a href="{{ route('catalog.index') }}" class="btn btn-primary">
                    <i class="ki-duotone ki-arrow-left fs-3"><span class="path1"></span><span class="path2"></span></i> Kembali ke Katalog
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
