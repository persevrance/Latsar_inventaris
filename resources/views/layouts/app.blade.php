<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Inventaris UPA-TIK')</title>

    {{-- APP ASSETS --}}
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- OPTIONAL CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')

</head>

<body x-data="{ sidebarOpen: false }" class="bg-gray-50 text-gray-800 py-4 lg:py-0">

    {{-- HAMBURGER (mobile) --}}
    <button @click="sidebarOpen = true"
        class="lg:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-2 rounded-md shadow">
        ☰
    </button>

    {{-- SIDEBAR (pakai component) --}}
    @php
    $role = auth()->user()->role ?? null;
    @endphp

    @include('components.sidebar', compact('role'))

    {{-- OVERLAY --}}
    <div x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 z-40 lg:hidden"
        x-transition.opacity>
    </div>


    {{-- MAIN CONTENT --}}
    <main class="min-h-screen transition-all duration-300 lg:ml-64 p-6">

        {{-- FLASH MESSAGE --}}
        @include('components.flash')

        {{-- CONTENT --}}
        @yield('content')

    </main>

    {{-- GLOBAL LOADING --}}
    <div id="global-loading" class="fixed inset-0 bg-black/40 z-[9999] hidden">
        <div class="w-full h-full flex items-center justify-center">
            <div class="bg-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
                <svg class="animate-spin h-5 w-5 text-blue-600" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                <span class="text-gray-700 font-medium">
                    Sedang memproses…
                </span>
            </div>
        </div>
    </div>

    {{-- JS LIBRARY --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- GLOBAL SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // TOM SELECT
            document.querySelectorAll('[data-tomselect]').forEach(el => {
                if (!el.tomselect) {
                    new TomSelect(el, {
                        create: false,
                        sortField: {
                            field: 'text',
                            direction: 'asc'
                        }
                    })
                }
            })

            // DATEPICKER
            document.querySelectorAll('[data-datepicker]').forEach(el => {
                flatpickr(el, {
                    dateFormat: 'Y-m-d'
                })
            })

            // MODAL HANDLER
            document.addEventListener('click', function(e) {

                const openBtn = e.target.closest('[data-modal-target]')
                if (openBtn) {
                    e.preventDefault()

                    const modal = document.getElementById(openBtn.dataset.modalTarget)
                    if (!modal) return

                    modal.classList.remove('hidden')
                    modal.classList.add('flex')
                    document.body.classList.add('overflow-hidden')
                    return
                }

                const closeBtn = e.target.closest('[data-modal-close]')
                if (closeBtn) {
                    const modal = closeBtn.closest('.fixed.inset-0')
                    if (!modal) return

                    modal.classList.add('hidden')
                    modal.classList.remove('flex')
                    document.body.classList.remove('overflow-hidden')
                    return
                }

                if (e.target.classList.contains('modal-overlay')) {
                    const modal = e.target.closest('.fixed.inset-0')
                    if (!modal) return

                    modal.classList.add('hidden')
                    modal.classList.remove('flex')
                    document.body.classList.remove('overflow-hidden')
                }
            })

            // ESC CLOSE MODAL
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.fixed.inset-0.flex').forEach(modal => {
                        modal.classList.add('hidden')
                        modal.classList.remove('flex')
                    })
                    document.body.classList.remove('overflow-hidden')
                }
            })
        })

        // GLOBAL LOADING
        window.showLoading = function() {
            document.getElementById('global-loading')?.classList.remove('hidden')
        }

        window.hideLoading = function() {
            document.getElementById('global-loading')?.classList.add('hidden')
        }

        window.addEventListener('load', hideLoading)

        // LOGOUT CONFIRM
        window.confirmLogout = function() {
            Swal.fire({
                title: 'Logout?',
                text: 'Yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form')?.submit()
                }
            })
        }
    </script>

    @stack('scripts')

</body>

</html>