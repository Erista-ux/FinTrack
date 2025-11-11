<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Tampilkan semua user
    public function index() {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    // Form tambah user
    public function create() {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Simpan user baru
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|min:6',
            'type' => 'in:standard,advance,admin',
        ]);

        $validated['password'] = Hash::make($request->password);
        User::create($validated);

        return redirect()->route('pages.users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // Tampilkan detail user
    public function show(User $user) {
        return view('pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Form edit user
    public function edit(User $user) {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Update data user
    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required|string|unique:users,username,'.$user->id,
            'type' => 'in:standard,advance,admin',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);
        return redirect()->route('pages.users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Hapus user
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('pages.users.index')->with('success', 'User berhasil dihapus');
    }
}
