@extends('layouts.app')

@section('title', 'Tambah Buku Fisik')
@section('page-title', 'Tambah Buku Fisik')

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
    <li class="breadcrumb-item text-gray-900">Tambah</li>
</ul>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-header">
            <h3 class="card-title">Form Tambah Buku Fisik</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label required">Kode / ISBN</label>
                        <input type="text" name="code" class="form-control form-control-solid @error('code') is-invalid @enderror"
                            placeholder="Masukkan kode buku atau ISBN" value="{{ old('code') }}"/>
                        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label required">Judul Buku</label>
                        <input type="text" name="title" class="form-control form-control-solid @error('title') is-invalid @enderror"
                            placeholder="Masukkan judul buku" value="{{ old('title') }}"/>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label required">Penulis</label>
                        <input type="text" name="author" class="form-control form-control-solid @error('author') is-invalid @enderror"
                            placeholder="Nama penulis" value="{{ old('author') }}"/>
                        @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label">Penerbit</label>
                        <input type="text" name="publisher" class="form-control form-control-solid @error('publisher') is-invalid @enderror"
                            placeholder="Nama penerbit" value="{{ old('publisher') }}"/>
                        @error('publisher')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-10">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="year" class="form-control form-control-solid @error('year') is-invalid @enderror"
                            placeholder="2024" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}"/>
                        @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-10">
                        <label class="form-label required">Stok</label>
                        <input type="number" name="stock" class="form-control form-control-solid @error('stock') is-invalid @enderror"
                            placeholder="0" value="{{ old('stock', 0) }}" min="0"/>
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-10">
                        <label class="form-label">Cover Buku</label>
                        <input type="file" name="cover_image" class="form-control form-control-solid @error('cover_image') is-invalid @enderror"
                            accept="image/jpg,image/jpeg,image/png,image/webp"/>
                        @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">Format: JPG, PNG, WebP. Max: 2MB</div>
                    </div>
                </div>
            </div>
            <div class="mb-10">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror"
                    rows="5" placeholder="Deskripsi buku (opsional)">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('admin.books.index') }}" class="btn btn-light me-3">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
