<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.profile');
    }

    public function update(Request $request)
    {
        try {
            $user = auth()->user();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,

                'current_password' => 'required_with:password',

                'password' => 'nullable|min:8|confirmed',
            ]);

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->filled('password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()
                        ->withErrors([
                            'current_password' => 'Password lama tidak sesuai.',
                        ])
                        ->withInput();
                }

                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('profile.index')->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }
    }
}
