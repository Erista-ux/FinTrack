@extends('layouts.app')

@section('title', 'Tambah Transaksi Penjualan - Fintrack')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah Transaksi Penjualan</h1>
            <p class="text-gray-600">Isi form berikut untuk menambahkan transaksi penjualan baru</p>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-2xl card-shadow p-6">
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Kode Transaksi -->
                    <div class="md:col-span-2">
                        <label for="kode_transaksi" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Transaksi *
                        </label>
                        <input type="text"
                               id="kode_transaksi"
                               name="kode_transaksi"
                               value="{{ old('kode_transaksi') }}"
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
                               value="{{ old('nama_pelanggan') }}"
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
                               value="{{ old('total') }}"
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
                            <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="pending" {{ old('status_pembayaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dibatalkan" {{ old('status_pembayaran') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status_pembayaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('sales.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="text-sm font-semibold text-blue-800">Tips</h3>
                    <p class="text-sm text-blue-600 mt-1">
                        Pastikan kode transaksi unik dan tidak duplikat. Status pembayaran dapat diubah nanti jika diperlukan.
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

    // Generate kode transaksi otomatis
    document.addEventListener('DOMContentLoaded', function() {
        const kodeInput = document.getElementById('kode_transaksi');
        if (!kodeInput.value) {
            const timestamp = new Date().getTime();
            kodeInput.value = 'TRX-' + timestamp.toString().slice(-4);
        }
    });
</script>
@endsection
