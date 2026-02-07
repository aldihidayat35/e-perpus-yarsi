@extends('layouts.app')

@section('title', 'Detail E-Book')
@section('page-title', 'Detail E-Book')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.ebooks.index') }}" class="text-muted text-hover-primary">E-Book</a>
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
                            <div class="symbol-label fs-1 fw-semibold bg-light-info text-info">
                                <i class="ki-duotone ki-tablet-book fs-3x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                    @endif
                    <span class="fs-3 text-gray-800 fw-bold mb-1">{{ $book->title }}</span>
                    <span class="fs-5 fw-semibold text-gray-500 mb-6">{{ $book->author }}</span>
                    <div class="d-flex flex-wrap flex-center">
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 me-3">
                            <div class="fs-4 fw-bold text-gray-700">{{ $book->ebook->total_pages ?? '-' }}</div>
                            <div class="fw-semibold text-muted">Halaman</div>
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-gray-600 fs-7">File PDF</span>
                        @if($book->ebook && $book->ebook->file_path)
                            <span class="badge badge-light-success">Tersedia</span>
                        @else
                            <span class="badge badge-light-danger">Tidak Ada</span>
                        @endif
                    </div>
                </div>
                <div class="d-flex flex-center">
                    <a href="{{ route('admin.ebooks.edit', $book) }}" class="btn btn-sm btn-light-primary me-3">
                        <i class="ki-duotone ki-pencil fs-5"></i> Edit
                    </a>
                    @if($book->ebook && $book->ebook->file_path)
                    <a href="{{ route('ebook.reader', $book) }}" class="btn btn-sm btn-light-info me-3" target="_blank">
                        <i class="ki-duotone ki-eye fs-5"></i> Baca
                    </a>
                    @endif
                    <a href="{{ route('admin.ebooks.index') }}" class="btn btn-sm btn-light">Kembali</a>
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
    </div>
</div>
@endsection
