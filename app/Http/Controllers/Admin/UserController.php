<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Display a listing of users.
    public function index()
    {
        // Ambil semua user, diurutkan berdasarkan nama
        $users = User::orderBy('nama', 'asc')->get();

        return view('admin.data_user.data_user', compact('users'));
    }

    /**
     * Show form untuk tambah user
     */
    public function create()
    {
        return view('admin.data_user.tambah_user');
    }

    /**
     * Store user baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'email.max' => 'Email maksimal 255 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show form edit user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.data_user.edit_user', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('user', 'email')->ignore($user->iduser, 'iduser')],
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'email.max' => 'Email maksimal 255 karakter',
        ]);

        $user->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * Show form reset password
     */
    public function showResetPassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.data_user.reset_password', compact('user'));
    }

    /**
     * Reset password user
     */
    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'Password berhasil direset');
    }

    //DISABLED: Delete operation

    // public function destroy(User $user)
    // {
    //     $user->delete();

    //     return redirect()->route('admin.user.index')
    //         ->with('success', 'User berhasil dihapus');
    // }
}
