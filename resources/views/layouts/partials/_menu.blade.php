<!--begin::Menu-->
<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="#kt_aside_toolbar, #kt_aside_footer"
    data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">

    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
        id="#kt_aside_menu" data-kt-menu="true">

        <!--begin::Menu item - Dashboard-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-element-11 fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </div>
        <!--end::Menu item-->

        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Perpustakaan</span>
            </div>
        </div>

        <!--begin::Menu item - Categories-->
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('admin.categories.*') ? 'here show' : '' }}">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-duotone ki-category fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                </span>
                <span class="menu-title">Kategori</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Daftar Kategori</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}" href="{{ route('admin.categories.create') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Tambah Kategori</span>
                    </a>
                </div>
            </div>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item - Physical Books-->
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('admin.books.*') ? 'here show' : '' }}">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-duotone ki-book-open fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                </span>
                <span class="menu-title">Buku Fisik</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.books.index') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Daftar Buku</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.books.create') ? 'active' : '' }}" href="{{ route('admin.books.create') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Tambah Buku</span>
                    </a>
                </div>
            </div>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item - E-Books-->
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('admin.ebooks.*') ? 'here show' : '' }}">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-duotone ki-tablet-book fs-2"><span class="path1"></span><span class="path2"></span></i>
                </span>
                <span class="menu-title">E-Book</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.ebooks.index') ? 'active' : '' }}" href="{{ route('admin.ebooks.index') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Daftar E-Book</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.ebooks.create') ? 'active' : '' }}" href="{{ route('admin.ebooks.create') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Tambah E-Book</span>
                    </a>
                </div>
            </div>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item - Loans-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}" href="{{ route('admin.loans.index') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-handcart fs-2"><span class="path1"></span><span class="path2"></span></i>
                </span>
                <span class="menu-title">Peminjaman</span>
            </a>
        </div>
        <!--end::Menu item-->

        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Manajemen</span>
            </div>
        </div>

        <!--begin::Menu item - User Management-->
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('admin.users.*') ? 'here show' : '' }}">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-duotone ki-people fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                </span>
                <span class="menu-title">Manajemen User</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Daftar User</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.users.create') ? 'active' : '' }}" href="{{ route('admin.users.create') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Tambah User</span>
                    </a>
                </div>
            </div>
        </div>
        <!--end::Menu item-->

        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Pengaturan</span>
            </div>
        </div>

        <!--begin::Menu item - App Settings-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-setting-2 fs-2"><span class="path1"></span><span class="path2"></span></i>
                </span>
                <span class="menu-title">Data Aplikasi</span>
            </a>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item - Public Site-->
        <div class="menu-item">
            <a class="menu-link" href="{{ route('catalog.index') }}" target="_blank">
                <span class="menu-icon">
                    <i class="ki-duotone ki-globe fs-2"><span class="path1"></span><span class="path2"></span></i>
                </span>
                <span class="menu-title">Lihat Katalog Publik</span>
            </a>
        </div>
        <!--end::Menu item-->
    </div>
</div>
<!--end::Menu-->
