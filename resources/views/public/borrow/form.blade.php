@extends('layouts.public')

@section('title', 'Pinjam Buku - ' . $book->title)

@section('content')
<div class="mb-5">
    <a href="{{ route('catalog.show', $book) }}" class="btn btn-sm btn-light">
        <i class="ki-duotone ki-arrow-left fs-4"><span class="path1"></span><span class="path2"></span></i> Kembali ke Detail Buku
    </a>
</div>

<div class="row g-5 g-xl-10 justify-content-center">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ki-duotone ki-handcart fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>
                    Form Peminjaman Buku
                </h3>
            </div>
            <div class="card-body">
                <!--begin::Book Info-->
                <div class="d-flex align-items-center bg-light-primary rounded p-5 mb-8">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                            class="rounded me-5" style="width: 60px; height: 80px; object-fit: cover;"/>
                    @else
                        <div class="symbol symbol-60px me-5">
                            <div class="symbol-label bg-light-info">
                                <i class="ki-duotone ki-book fs-2x text-info"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                    @endif
                    <div>
                        <span class="fw-bold text-gray-900 fs-5 d-block">{{ $book->title }}</span>
                        <span class="text-muted fs-7">{{ $book->author }} &bull; {{ $book->code }}</span>
                        <div class="mt-1">
                            <span class="badge badge-light-success">Stok: {{ $book->stock }}</span>
                        </div>
                    </div>
                </div>
                <!--end::Book Info-->

                @if($book->stock <= 0)
                    <div class="alert alert-danger">
                        <i class="ki-duotone ki-information fs-3 text-danger me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        Maaf, stok buku ini sedang habis. Silakan coba lagi nanti.
                    </div>
                @else
                <form action="{{ route('borrow.store', $book) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-8">
                                <label class="form-label required fs-6 fw-semibold">Nama Lengkap</label>
                                <input type="text" name="borrower_name"
                                    class="form-control form-control-solid @error('borrower_name') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap" value="{{ old('borrower_name') }}"/>
                                @error('borrower_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-8">
                                <label class="form-label required fs-6 fw-semibold">No. Telepon / WhatsApp</label>
                                <input type="text" name="borrower_phone"
                                    class="form-control form-control-solid @error('borrower_phone') is-invalid @enderror"
                                    placeholder="08xxxxxxxxxx" value="{{ old('borrower_phone') }}"/>
                                @error('borrower_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-8">
                                <label class="form-label fs-6 fw-semibold">Email <span class="text-muted">(opsional)</span></label>
                                <input type="email" name="borrower_email"
                                    class="form-control form-control-solid @error('borrower_email') is-invalid @enderror"
                                    placeholder="email@contoh.com" value="{{ old('borrower_email') }}"/>
                                @error('borrower_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-8">
                                <label class="form-label fs-6 fw-semibold">No. Identitas (KTP/NIM) <span class="text-muted">(opsional)</span></label>
                                <input type="text" name="identity_number"
                                    class="form-control form-control-solid @error('identity_number') is-invalid @enderror"
                                    placeholder="Nomor identitas" value="{{ old('identity_number') }}"/>
                                @error('identity_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-8">
                        <label class="form-label required fs-6 fw-semibold">Durasi Peminjaman</label>
                        <select name="loan_duration" class="form-select form-select-solid @error('loan_duration') is-invalid @enderror">
                            <option value="">Pilih durasi...</option>
                            <option value="3" {{ old('loan_duration') == '3' ? 'selected' : '' }}>3 hari</option>
                            <option value="7" {{ old('loan_duration', '7') == '7' ? 'selected' : '' }}>7 hari (1 minggu)</option>
                            <option value="14" {{ old('loan_duration') == '14' ? 'selected' : '' }}>14 hari (2 minggu)</option>
                            <option value="21" {{ old('loan_duration') == '21' ? 'selected' : '' }}>21 hari (3 minggu)</option>
                            <option value="30" {{ old('loan_duration') == '30' ? 'selected' : '' }}>30 hari (1 bulan)</option>
                        </select>
                        @error('loan_duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="separator separator-dashed my-8"></div>

                    <div class="mb-8">
                        <div class="form-check form-check-custom form-check-solid">
                            <input type="checkbox" name="confirmation" value="1"
                                class="form-check-input @error('confirmation') is-invalid @enderror" id="confirmation"
                                {{ old('confirmation') ? 'checked' : '' }}/>
                            <label class="form-check-label fw-semibold text-gray-700" for="confirmation">
                                Saya menyetujui ketentuan peminjaman dan berjanji mengembalikan buku tepat waktu.
                            </label>
                            @error('confirmation')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('catalog.show', $book) }}" class="btn btn-light me-3">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-duotone ki-check fs-3"><span class="path1"></span><span class="path2"></span></i> Ajukan Peminjaman
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
