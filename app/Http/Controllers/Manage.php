<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserModel;

class Manage extends Controller
{
    
    // Tampilkan daftar user
    public function index()
    {
        $users = UserModel::all();
        $navbar = 'User Management';
        return view('user_management', compact('users', 'navbar'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        $navbar = 'User Create';
        return view('user_create', compact('navbar'));
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
        return redirect()->route('manage.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form edit user
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $navbar = 'User Edit';
        return view('user_edit', compact('user', 'navbar'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,pj,user,guest',
            // 'is_active' => 'required|boolean',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }
        $user->update($validated);
        return redirect()->route('manage.index')->with('success', 'User berhasil diupdate.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        if (auth()->user()->id == $user->id) {
            return redirect()->route('manage.index')->with('error', 'Tidak bisa menghapus user sendiri.');
        }
        $user->delete();
        return redirect()->route('manage.index')->with('success', 'User berhasil dihapus.');
    }

}