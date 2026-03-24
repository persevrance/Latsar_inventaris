<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">

    @if($role == 'admin')
    <ul class="space-y-2">
        <li><a href="/admin/dashboard">Dashboard</a></li>
        <li><a href="/admin/barang">Barang</a></li>
        <li><a href="/admin/barang-item">Barang Item</a></li>
        <li><a href="/admin/peminjaman">Peminjaman</a></li>
        <li><a href="/admin/pengembalian">Pengembalian</a></li>
        <li><a href="/admin/laporan">Laporan</a></li>
    </ul>
    @else
    <ul class="space-y-2">
        <li><a href="/pegawai/dashboard">Dashboard</a></li>
        <li><a href="/pegawai/barang">Barang</a></li>
        <li><a href="/pegawai/peminjaman">Peminjaman</a></li>
    </ul>
    @endif

</aside>