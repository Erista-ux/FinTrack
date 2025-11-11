@extends('layouts.app')

@section('title', 'Edit Transaksi Penjualan - Fintrack')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Transaksi Penjualan</h1>
            <p class="text-gray-600">Perbarui informasi transaksi penjualan</p>
            <div class="mt-2 text-sm text-gray-500">
                <span class="bg-gray-100 px-2 py-1 rounded">ID: {{ $sale['id'] }}</span>
                <span class="bg-gray-100 px-2 py-1 rounded ml-2">Tanggal: {{ $sale['tanggal'] }}</span>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-2xl card-shadow p-6">
            <form action="{{ route('sales.update', $sale['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Kode Transaksi -->
                    <div class="md:col-span-2">
                        <label for="kode_transaksi" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Transaksi *
                        </label>
                        <input type="text"
                               id="kode_transaksi"
                               name="kode_transaksi"
                               value="{{ old('kode_transaksi', $sale['kode_transaksi']) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                               placeholder="Contoh: TRX-001"
                               required>
                        @error('kode_transaksi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Pelanggan -->
                    <div class="md:col-span-2">
                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pelanggan *
                        </label>
                        <input type="text"
                               id="nama_pelanggan"
                               name="nama_pelanggan"
                               value="{{ old('nama_pelanggan', $sale['nama_pelanggan']) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                               placeholder="Masukkan nama pelanggan"
                               required>
                        @error('nama_pelanggan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total -->
                    <div class="md:col-span-2">
                        <label for="total" class="block text-sm font-medium text-gray-700 mb-2">
                            Total Transaksi (Rp) *
                        </label>
                        <input type="number"
                               id="total"
                               name="total"
                               value="{{ old('total', $sale['total']) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                               placeholder="0"
                               min="0"
                               step="1000"
                               required>
                        @error('total')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="md:col-span-2">
                        <label for="status_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                            Status Pembayaran *
                        </label>
                        <select id="status_pembayaran"
                                name="status_pembayaran"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                                required>
                            <option value="">Pilih Status Pembayaran</option>
                            <option value="lunas" {{ (old('status_pembayaran', $sale['status_pembayaran']) == 'lunas') ? 'selected' : '' }}>Lunas</option>
                            <option value="pending" {{ (old('status_pembayaran', $sale['status_pembayaran']) == 'pending') ? 'selected' : '' }}>Pending</option>
                            <option value="dibatalkan" {{ (old('status_pembayaran', $sale['status_pembayaran']) == 'dibatalkan') ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status_pembayaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="md:col-span-2">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">Informasi Transaksi</h3>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-500">ID Transaksi:</span>
                                    <p class="font-medium">{{ $sale['id'] }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Tanggal Dibuat:</span>
                                    <p class="font-medium">{{ $sale['tanggal'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                    <div>
                        <a href="{{ route('sales.index') }}"
                           class="text-gray-600 hover:text-gray-800 transition flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('sales.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">
                            Update Transaksi
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Status Badge Preview -->
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div>
                    <h3 class="text-sm font-semibold text-yellow-800">Preview Status</h3>
                    <p class="text-sm text-yellow-600 mt-1">
                        Status saat ini:
                        @if($sale['status_pembayaran'] == 'lunas')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                        @elseif($sale['status_pembayaran'] == 'pending')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Format input total dengan separator
    document.getElementById('total').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\./g, '');
        if (!isNaN(value)) {
            e.target.value = new Intl.NumberFormat('id-ID').format(value);
        }
    });

    // Real-time status preview
    document.getElementById('status_pembayaran').addEventListener('change', function(e) {
        const status = e.target.value;
        const previewText = document.querySelector('.text-yellow-600 span');

        if (status === 'lunas') {
            previewText.className = 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
            previewText.textContent = 'Lunas';
        } else if (status === 'pending') {
            previewText.className = 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800';
            previewText.textContent = 'Pending';
        } else if (status === 'dibatalkan') {
            previewText.className = 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800';
            previewText.textContent = 'Dibatalkan';
        }
    });
</script>
@endsection
