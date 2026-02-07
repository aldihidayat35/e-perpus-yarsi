@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-900">Dashboard</li>
</ul>
@endsection

@section('content')
<!--begin::Row - Library Stats-->
<div class="row g-5 g-xl-8 mb-5">
    <div class="col-xl-3">
        <a href="{{ route('admin.books.index') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
                <i class="ki-duotone ki-book fs-2x text-primary ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ $totalBooks }}</div>
                <div class="fw-semibold text-gray-400">Total Buku</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3">
        <a href="{{ route('admin.books.index') }}" class="card bg-info hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
                <i class="ki-duotone ki-book-open text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $totalPhysical }}</div>
                <div class="fw-semibold text-white">Buku Fisik</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3">
        <a href="{{ route('admin.ebooks.index') }}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
                <i class="ki-duotone ki-tablet-book text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span></i>
                <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $totalEbooks }}</div>
                <div class="fw-semibold text-white">E-Book</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3">
        <a href="{{ route('admin.loans.index') }}" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
                <i class="ki-duotone ki-handcart text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span></i>
                <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $booksBorrowed }}</div>
                <div class="fw-semibold text-white">Sedang Dipinjam</div>
            </div>
        </a>
    </div>
</div>
<!--end::Row-->

<!--begin::Row - Alerts & Quick Stats-->
<div class="row g-5 g-xl-8 mb-5">
    @if($lateReturns > 0)
    <div class="col-xl-4">
        <div class="card bg-danger hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
                <i class="ki-duotone ki-timer text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $lateReturns }}</div>
                <div class="fw-semibold text-white">Pengembalian Terlambat</div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-xl-{{ $lateReturns > 0 ? '4' : '6' }}">
        <div class="card bg-success hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
                <i class="ki-duotone ki-people text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $totalUsers }}</div>
                <div class="fw-semibold text-white">Total User</div>
            </div>
        </div>
    </div>
    <div class="col-xl-{{ $lateReturns > 0 ? '4' : '6' }}">
        <a href="{{ route('admin.settings.index') }}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
                <i class="ki-duotone ki-setting-2 text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span></i>
                <div class="text-white fw-bold fs-2 mb-2 mt-5">
                    <i class="ki-duotone ki-arrow-right text-white fs-2"></i>
                </div>
                <div class="fw-semibold text-white">Pengaturan Aplikasi</div>
            </div>
        </a>
    </div>
</div>
<!--end::Row-->

<!--begin::Row - Recent Loans & Users-->
<div class="row g-5 g-xl-8">
    <div class="col-xl-7">
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Peminjaman Terbaru</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">{{ $booksBorrowed }} buku sedang dipinjam</span>
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.loans.index') }}" class="btn btn-sm btn-light-primary">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-150px">Peminjam</th>
                                <th class="min-w-150px">Buku</th>
                                <th class="min-w-100px">Jatuh Tempo</th>
                                <th class="min-w-80px">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLoans as $loan)
                            <tr>
                                <td>
                                    <span class="text-gray-900 fw-bold d-block fs-6">{{ $loan->borrower_name }}</span>
                                    <span class="text-muted fw-semibold d-block fs-7">{{ $loan->borrower_phone }}</span>
                                </td>
                                <td><span class="text-gray-800 fw-semibold">{{ Str::limit($loan->book->title ?? '-', 30) }}</span></td>
                                <td><span class="text-muted fw-semibold">{{ $loan->due_date->format('d M Y') }}</span></td>
                                <td>{!! $loan->status_badge !!}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-10">Belum ada data peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">User Terbaru</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">{{ $totalUsers }} user terdaftar</span>
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-200px">User</th>
                                <th class="min-w-100px">Role</th>
                                <th class="min-w-100px">Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            @if($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt=""/>
                                            @else
                                                <div class="symbol-label fs-5 fw-semibold bg-light-primary text-primary">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-900 fw-bold fs-6">{{ $user->name }}</span>
                                            <span class="text-muted fw-semibold fs-7">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ $user->role === 'admin' ? 'danger' : 'primary' }} fs-7 fw-semibold">{{ ucfirst($user->role) }}</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">{{ $user->created_at->format('d M Y') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-10">Belum ada user</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Row-->
@endsection
