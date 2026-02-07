@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

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
    <li class="breadcrumb-item text-gray-900">Edit</li>
</ul>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-header">
            <h3 class="card-title">Edit Kategori: {{ $category->name }}</h3>
        </div>
        <div class="card-body">
            <div class="mb-10">
                <label class="form-label required">Nama Kategori</label>
                <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror"
                    value="{{ old('name', $category->name) }}"/>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-10">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror"
                    rows="4">{{ old('description', $category->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light me-3">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
    </form>
</div>
@endsection
