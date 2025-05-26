<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Controller
{
    
    public function profile()
    {
        $user = Auth::user();
        $navbar = 'Profil';
        $username = $user['name'];

        return view('profile', compact('user','navbar','username'));
    }

    // Tampilkan form edit profil
    public function edit()
    {
        $user = Auth::user();
        $navbar = 'Profil';
        return view('profile_edit', compact('user','navbar'));
    }

    // Proses update profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:30',
            'bio'      => 'nullable|string|max:1000',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name     = $validated['name'];
        $user->email    = $validated['email'];
        $user->phone    = $validated['phone'] ?? null;
        $user->bio      = $validated['bio'] ?? null;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada dan file-nya memang ada di storage
            if ($user->photo_url && Storage::disk('public')->exists($user->photo_url)) {
                Storage::disk('public')->delete($user->photo_url);
            }
            // Upload foto baru ke storage di folder assets/user_photos
            $path = $request->file('photo')->store('/assets/user_photos', 'public');
            $user->photo_url = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}