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

    //DISABLED: Create operation

    // public function create()
    // {
    //     return view('admin.data_user.tambah_user');
    // }

    //DISABLED: Create operation

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:user,email',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //     ]);

    //     return redirect()->route('admin.user.index')
    //         ->with('success', 'User berhasil ditambahkan');
    // }

    //DISABLED: Update operation

    // public function edit(User $user)
    // {
    //     return view('admin.data_user.edit_user', compact('user'));
    // }

    //DISABLED: Update operation

    // public function update(Request $request, User $user)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => ['required', 'string', 'email', 'max:255', Rule::unique('user', 'email')->ignore($user->iduser, 'iduser')],
    //     ]);

    //     $user->update([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //     ]);

    //     return redirect()->route('admin.user.index')
    //         ->with('success', 'User berhasil diupdate');
    // }

    //DISABLED: Update operation

    // public function showResetPassword(User $user)
    // {
    //     return view('admin.data_user.reset_password', compact('user'));
    // }

    //DISABLED: Update operation

    // public function resetPassword(Request $request, User $user)
    // {
    //     $validated = $request->validate([
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user->update([
    //         'password' => Hash::make($validated['password']),
    //     ]);

    //     return redirect()->route('admin.user.index')
    //         ->with('success', 'Password berhasil direset');
    // }

    //DISABLED: Delete operation

    // public function destroy(User $user)
    // {
    //     $user->delete();

    //     return redirect()->route('admin.user.index')
    //         ->with('success', 'User berhasil dihapus');
    // }
}
