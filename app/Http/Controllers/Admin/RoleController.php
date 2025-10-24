<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;

class RoleController extends Controller
{
    /**
     * Display a listing of users with their roles.
     */
    public function index()
    {
        // Jika tabel pivot / role belum dibuat di database, hindari eager loading
        // untuk mencegah QueryException. Kembalikan users tanpa relasi roles.
        if (Schema::hasTable('role_user') && Schema::hasTable('role')) {
            // Ambil semua user dengan roles mereka
            $users = User::with(['roles' => function($query) {
                $query->orderBy('nama_role', 'asc');
            }])->orderBy('nama', 'asc')->get();

            // Ambil semua roles yang tersedia
            $allRoles = Role::orderBy('nama_role', 'asc')->get();
        } else {
            // Fallback: kembalikan users tanpa roles (kosong)
            $users = User::orderBy('nama', 'asc')->get();
            foreach ($users as $u) {
                $u->setRelation('roles', collect());
            }
            $allRoles = collect();
        }

        return view('admin.manajemen_role.manajemen_role', compact('users', 'allRoles'));
    }

    // ========== CRUD OPERATIONS (DISABLED FOR NOW) ==========
    // Fitur Assign/Update/Delete role dinonaktifkan sementara
    // Hanya fitur View/Read yang aktif
    
    /**
     * Assign a role to a user.
     * DISABLED: Assign role operation
     */
    // public function assignRole(Request $request)
    // {
    //     $validated = $request->validate([
    //         'iduser' => 'required|exists:user,iduser',
    //         'idrole' => 'required|exists:role,idrole',
    //         'status' => 'required|in:0,1',
    //     ]);

    //     // Cek apakah user sudah punya role ini
    //     $exists = UserRole::where('iduser', $validated['iduser'])
    //                       ->where('idrole', $validated['idrole'])
    //                       ->first();

    //     if ($exists) {
    //         return redirect()->route('admin.role.index')
    //             ->with('error', 'User sudah memiliki role ini');
    //     }

    //     // Buat user role baru
    //     UserRole::create([
    //         'iduser' => $validated['iduser'],
    //         'idrole' => $validated['idrole'],
    //         'status' => $validated['status'],
    //     ]);

    //     return redirect()->route('admin.role.index')
    //         ->with('success', 'Role berhasil ditambahkan ke user');
    // }

    /**
     * Update the status of a user role.
     * DISABLED: Update role status operation
     */
    // public function updateRoleStatus(Request $request, $idrole_user)
    // {
    //     $validated = $request->validate([
    //         'status' => 'required|in:0,1',
    //     ]);

    //     $userRole = UserRole::findOrFail($idrole_user);
    //     $userRole->update(['status' => $validated['status']]);

    //     return redirect()->route('admin.role.index')
    //         ->with('success', 'Status role berhasil diupdate');
    // }

    /**
     * Remove a role from a user.
     * DISABLED: Delete role operation
     */
    // public function removeRole($idrole_user)
    // {
    //     $userRole = UserRole::findOrFail($idrole_user);
    //     $userRole->delete();

    //     return redirect()->route('admin.role.index')
    //         ->with('success', 'Role berhasil dihapus dari user');
    // }

    /**
     * Display the form for creating a new role.
     * DISABLED: Create role operation
     */
    // public function createRole()
    // {
    //     return view('admin.manajemen_role.tambah_role');
    // }

    /**
     * Store a newly created role.
     * DISABLED: Create role operation
     */
    // public function storeRole(Request $request)
    // {
    //     $validated = $request->validate([
    //         'nama_role' => 'required|string|max:50|unique:role,nama_role',
    //         'deskripsi' => 'nullable|string|max:255',
    //     ]);

    //     Role::create($validated);

    //     return redirect()->route('admin.role.index')
    //         ->with('success', 'Role baru berhasil ditambahkan');
    // }
}
