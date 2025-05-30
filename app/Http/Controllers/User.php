<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserModel;

class User extends Controller
{
    
    // Tampilkan daftar user
    public function index()
    {
        $users = UserModel::all();
        return view('user_management', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('user_create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,pj,user,guest',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = true;
        UserModel::create($validated);
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form edit user
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('user_edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,pj,user,guest',
            'is_active' => 'required|boolean',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }
        $user->update($validated);
        return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        if (auth()->user()->id == $user->id) {
            return redirect()->route('user.index')->with('error', 'Tidak bisa menghapus user sendiri.');
        }
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }

}