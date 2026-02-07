@extends('layouts.app')

@section('title', 'Edit E-Book')
@section('page-title', 'Edit E-Book')

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
    <li class="breadcrumb-item text-gray-900">Edit</li>
</ul>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('admin.ebooks.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-header">
            <h3 class="card-title">Edit: {{ $book->title }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label required">Kode / ISBN</label>
                        <input type="text" name="code" class="form-control form-control-solid @error('code') is-invalid @enderror"
                            value="{{ old('code', $book->code) }}"/>
                        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label required">Judul E-Book</label>
                        <input type="text" name="title" class="form-control form-control-solid @error('title') is-invalid @enderror"
                            value="{{ old('title', $book->title) }}"/>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label required">Penulis</label>
                        <input type="text" name="author" class="form-control form-control-solid @error('author') is-invalid @enderror"
                            value="{{ old('author', $book->author) }}"/>
                        @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label">Penerbit</label>
                        <input type="text" name="publisher" class="form-control form-control-solid @error('publisher') is-invalid @enderror"
                            value="{{ old('publisher', $book->publisher) }}"/>
                        @error('publisher')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-10">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="year" class="form-control form-control-solid @error('year') is-invalid @enderror"
                            value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') + 1 }}"/>
                        @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-10">
                        <label class="form-label">Cover E-Book</label>
                        <input type="file" name="cover_image" class="form-control form-control-solid @error('cover_image') is-invalid @enderror"
                            accept="image/jpg,image/jpeg,image/png,image/webp"/>
                        @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if($book->cover_image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="rounded" style="max-height: 100px;"/>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-10">
                        <label class="form-label">File PDF</label>
                        <input type="file" name="pdf_file" class="form-control form-control-solid @error('pdf_file') is-invalid @enderror"
                            accept="application/pdf"/>
                        @error('pdf_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if($book->ebook && $book->ebook->file_path)
                            <div class="form-text text-success">
                                <i class="ki-duotone ki-check-circle fs-5 text-success"></i>
                                File PDF sudah ada ({{ $book->ebook->total_pages ?? '?' }} halaman). Upload baru untuk mengganti.
                            </div>
                        @else
                            <div class="form-text">Format: PDF. Max: 50MB</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-10">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror"
                    rows="5">{{ old('description', $book->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('admin.ebooks.index') }}" class="btn btn-light me-3">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
    </form>
</div>
@endsection
