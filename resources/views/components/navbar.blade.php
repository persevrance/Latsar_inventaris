<nav
    class="sticky top-0 z-50 bg-white border-b shadow-sm
           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100"
    x-data="{ open:false, openMenu:'' }">

    <!-- HEADER -->
    <div class="max-w-7xl mx-auto px-2 py-0 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between px-4 h-16">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/logopnb.png') }}" class="h-8 w-auto">
                <span class="font-semibold text-lg">Inventaris Barang UPA-TIK</span>
            </div>

        </div>

        <!-- ================= DROPDOWN ================= -->
        <div
            x-show="open"
            x-cloak
            x-transition
            @click.outside="open=false"
            class="md:hidden border-t bg-white dark:bg-gray-900 dark:border-gray-700">

            <nav class="px-4 py-4 space-y-2">
                <!-- LOGIN -->
                <a href="{{ route('login') }}"
                    @click.prevent="showLogin = true; open=false"
                    class="block px-3 py-2 rounded-lg
                      transition hover:bg-gray-100 dark:hover:bg-gray-800">
                    Masuk
                </a>

                <!-- divider -->
                <div class="border-b border-gray-100 dark:border-gray-800"></div>
            </nav>
        </div>
    </div>
</nav>