@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.categories.index') }}" class="text-muted text-hover-primary">Kategori</a>
    </li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-gray-900">Tambah</li>
</ul>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="card-header">
            <h3 class="card-title">Form Tambah Kategori</h3>
        </div>
        <div class="card-body">
            <div class="mb-10">
                <label class="form-label required">Nama Kategori</label>
                <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror"
                    placeholder="Masukkan nama kategori" value="{{ old('name') }}"/>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-10">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror"
                    rows="4" placeholder="Deskripsi kategori (opsional)">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light me-3">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
