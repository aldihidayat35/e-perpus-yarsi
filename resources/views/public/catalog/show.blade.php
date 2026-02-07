@extends('layouts.public')

@section('title', $book->title)

@section('content')
<div class="mb-5">
    <a href="{{ route('catalog.index') }}" class="btn btn-sm btn-light">
        <i class="ki-duotone ki-arrow-left fs-4"><span class="path1"></span><span class="path2"></span></i> Kembali ke Katalog
    </a>
</div>

<div class="row g-5 g-xl-10">
    <!--begin::Book Cover-->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body p-5 text-center">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                        class="rounded w-100" style="max-height: 400px; object-fit: cover;"/>
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 300px;">
                        @if($book->isPhysical())
                            <i class="ki-duotone ki-book-open fs-5x text-gray-300"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        @else
                            <i class="ki-duotone ki-tablet-book fs-5x text-gray-300"><span class="path1"></span><span class="path2"></span></i>
                        @endif
                    </div>
                @endif

                <div class="mt-5">
                    @if($book->isPhysical())
                        @if($book->stock > 0)
                            <a href="{{ route('borrow.create', $book) }}" class="btn btn-primary w-100 mb-2">
                                <i class="ki-duotone ki-handcart fs-3"><span class="path1"></span><span class="path2"></span></i> Pinjam Buku Ini
                            </a>
                            <span class="text-muted fs-7">Stok tersedia: {{ $book->stock }}</span>
                        @else
                            <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                        @endif
                    @else
                        @if($book->ebook)
                        <a href="{{ route('ebook.reader', $book) }}" class="btn btn-info w-100 mb-2">
                            <i class="ki-duotone ki-eye fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> Baca E-Book
                        </a>
                        @if($book->ebook->total_pages)
                            <span class="text-muted fs-7">{{ $book->ebook->total_pages }} halaman</span>
                        @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Book Cover-->

    <!--begin::Book Info-->
    <div class="col-md-8">
        <div class="card mb-5">
            <div class="card-body">
                <div class="mb-3">
                    @if($book->isPhysical())
                        <span class="badge badge-light-info">Buku Fisik</span>
                    @else
                        <span class="badge badge-light-primary">E-Book</span>
                    @endif
                </div>
                <h1 class="fw-bold text-gray-900 fs-2 mb-3">{{ $book->title }}</h1>
                <p class="text-gray-600 fs-5 mb-6">oleh <span class="fw-semibold text-gray-800">{{ $book->author }}</span></p>

                <div class="separator separator-dashed my-6"></div>

                <div class="row g-5">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-40px me-4">
                                <div class="symbol-label bg-light-info">
                                    <i class="ki-duotone ki-barcode fs-3 text-info"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></i>
                                </div>
                            </div>
                            <div>
                                <span class="text-muted fs-7 d-block">Kode / ISBN</span>
                                <span class="fw-bold text-gray-800">{{ $book->code }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-40px me-4">
                                <div class="symbol-label bg-light-primary">
                                    <i class="ki-duotone ki-office-bag fs-3 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                </div>
                            </div>
                            <div>
                                <span class="text-muted fs-7 d-block">Penerbit</span>
                                <span class="fw-bold text-gray-800">{{ $book->publisher ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-40px me-4">
                                <div class="symbol-label bg-light-warning">
                                    <i class="ki-duotone ki-calendar fs-3 text-warning"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div>
                                <span class="text-muted fs-7 d-block">Tahun Terbit</span>
                                <span class="fw-bold text-gray-800">{{ $book->year ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-40px me-4">
                                <div class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-category fs-3 text-success"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                </div>
                            </div>
                            <div>
                                <span class="text-muted fs-7 d-block">Kategori</span>
                                <span class="fw-bold text-gray-800">{{ $book->category->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($book->description)
                <div class="separator separator-dashed my-6"></div>
                <div>
                    <h4 class="fw-bold text-gray-800 mb-3">Deskripsi</h4>
                    <p class="text-gray-600 fs-6 lh-lg">{{ $book->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!--end::Book Info-->
</div>

<!--begin::Related Books-->
@if($relatedBooks->count() > 0)
<div class="mt-10">
    <h3 class="fw-bold text-gray-900 mb-6">Buku Terkait</h3>
    <div class="row g-6">
        @foreach($relatedBooks as $related)
        <div class="col-6 col-md-3">
            <div class="card book-card h-100">
                <a href="{{ route('catalog.show', $related) }}">
                    @if($related->cover_image)
                        <img src="{{ asset('storage/' . $related->cover_image) }}" alt="{{ $related->title }}" class="book-cover w-100"/>
                    @else
                        <div class="book-cover-placeholder">
                            <i class="ki-duotone ki-book fs-3x text-gray-300"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    @endif
                </a>
                <div class="card-body p-4">
                    <a href="{{ route('catalog.show', $related) }}" class="text-gray-900 text-hover-primary fw-bold fs-6 d-block mb-1">
                        {{ Str::limit($related->title, 30) }}
                    </a>
                    <span class="text-muted fs-7">{{ $related->author }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
<!--end::Related Books-->
@endsection
