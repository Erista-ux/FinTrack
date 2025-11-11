@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Data User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Username --}}
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username"
                   class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username', $user->username) }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password (opsional) --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru (Opsional)</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        </div>

        {{-- Tipe User --}}
        <div class="mb-3">
            <label for="type" class="form-label">Tipe Akun</label>
            <select name="type" id="type" class="form-select">
                <option value="standard" {{ $user->type == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="advance" {{ $user->type == 'advance' ? 'selected' : '' }}>Advance</option>
                <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        {{-- Nomor Telepon --}}
        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" id="phone"
                   class="form-control"
                   value="{{ old('phone', $user->phone) }}">
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" id="address" rows="3" class="form-control">{{ old('address', $user->address) }}</textarea>
        </div>

        {{-- Status Akun --}}
        <div class="mb-3">
            <label class="form-label">Status Akun</label>
            <select name="is_active" class="form-select">
                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
