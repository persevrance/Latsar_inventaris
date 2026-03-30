<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-64
           bg-gradient-to-b from-blue-700 via-blue-800 to-indigo-900
           text-white flex flex-col
           transform transition-transform duration-300 ease-in-out
           z-50 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    @php
    $user = auth()->user();

    // STYLE
    $baseLink = "relative flex items-center py-3 pl-6 pr-4 transition-all duration-300 rounded-l-full ml-auto font-medium text-sm";
    $active = "bg-gray-50 text-blue-900 font-bold shadow-md w-[92%]";
    $inactive = "text-blue-100 hover:bg-white/10 hover:text-white hover:w-[88%] hover:-translate-x-1";
    @endphp

    <div class="flex-1 overflow-y-auto no-scrollbar">

        {{-- BRAND --}}
        <div class="flex flex-wrap items-center justify-center gap-2 p-2 m-2 text-center">
            <img src="{{ asset('img/logopnb-putihtxt.png') }}" class="h-11 w-auto drop-shadow-md" alt="">
            <h2 class="font-bold text-lg tracking-wide text-white/90">
                Inventaris UPA-TIK
            </h2>
        </div>

        {{-- MENU --}}
        <nav class="py-4 space-y-1">

            <div class="space-y-1 mb-4">
                <p class="text-xs uppercase text-blue-300 font-bold px-6 mb-2 tracking-wider">
                    Main
                </p>

                {{-- DASHBOARD --}}
                <a href="{{ $user->role === 'admin' ? url('/admin/dashboard') : url('/pegawai/dashboard') }}"
                    class="{{ $baseLink }} {{ request()->is('*dashboard') ? $active : $inactive }}">
                    <span>Dashboard</span>
                </a>

                {{-- ================= ADMIN ================= --}}
                @if($user->role === 'admin')

                <a href="/admin/barang"
                    class="{{ $baseLink }} {{ request()->is('admin/barang*') ? $active : $inactive }}">
                    Barang
                </a>

                <a href="/admin/peminjaman"
                    class="{{ $baseLink }} {{ request()->is('admin/peminjaman*') ? $active : $inactive }}">
                    Peminjaman
                </a>

                <!-- <a href="/admin/pengembalian"
                    class="{{ $baseLink }} {{ request()->is('admin/pengembalian*') ? $active : $inactive }}">
                    Pengembalian
                </a> -->

                <a href="/admin/laporan"
                    class="{{ $baseLink }} {{ request()->is('admin/laporan*') ? $active : $inactive }}">
                    Laporan
                </a>

                <a href="/admin/history"
                    class="{{ $baseLink }} {{ request()->is('admin/history*') ? $active : $inactive }}">
                    History
                </a>

                <a href="/admin/users/create"
                    class="{{ $baseLink }} {{ request()->is('admin/users/create') ? $active : $inactive }}">
                    Tambah User
                </a>

                <a href="/admin/arsip"
                    class="{{ $baseLink }} {{ request()->is('admin/arsip*') ? $active : $inactive }}">
                    Arsip Barang
                </a>

                {{-- ================= PEGAWAI ================= --}}
                @else

                <a href="/pegawai/barang"
                    class="{{ $baseLink }} {{ request()->is('pegawai/barang*') ? $active : $inactive }}">
                    Barang
                </a>

                <a href="/pegawai/peminjaman"
                    class="{{ $baseLink }} {{ request()->is('pegawai/peminjaman*') ? $active : $inactive }}">
                    Peminjaman
                </a>

                <a href="/pegawai/history"
                    class="{{ $baseLink }} {{ request()->is('pegawai/history*') ? $active : $inactive }}">
                    History
                </a>

                @endif

            </div>

        </nav>
    </div>

    {{-- FOOTER --}}
    <div class="px-6 py-4 border-t border-white/10 bg-black/10">
        <p class="text-sm font-semibold text-white/90">
            {{ $user->nama ?? 'User' }}
        </p>
        <p class="text-xs text-blue-200">
            {{ $user->email }}
        </p>

        <div class="flex justify-end">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf

                <button type="button" onclick="confirmLogout()"
                    class="flex items-center gap-1.5 text-xs font-medium text-white/70 hover:text-red-300 transition">

                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>

                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>