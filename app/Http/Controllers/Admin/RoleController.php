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

    // ========== CRUD OPERATIONS ==========
    
    /**
     * Assign a role to a user.
     */
    public function assignRole(Request $request)
    {
        $validated = $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1',
        ], [
            'iduser.required' => 'User wajib dipilih',
            'iduser.exists' => 'User tidak ditemukan',
            'idrole.required' => 'Role wajib dipilih',
            'idrole.exists' => 'Role tidak ditemukan',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status harus Aktif atau Non-Aktif',
        ]);

        // Cek apakah user sudah punya role ini
        $exists = UserRole::where('iduser', $validated['iduser'])
                          ->where('idrole', $validated['idrole'])
                          ->first();

        if ($exists) {
            return redirect()->route('admin.role.index')
                ->with('error', 'User sudah memiliki role ini');
        }

        // Buat user role baru
        UserRole::create([
            'iduser' => $validated['iduser'],
            'idrole' => $validated['idrole'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil ditambahkan ke user');
    }

    /**
     * Update the status of a user role (Aktif/Nonaktif).
     */
    public function updateRoleStatus(Request $request, $idrole_user)
    {
        $validated = $request->validate([
            'status' => 'required|in:0,1',
        ], [
            'status.required' => 'Status wajib diisi',
            'status.in' => 'Status harus 0 (Nonaktif) atau 1 (Aktif)',
        ]);

        $userRole = UserRole::findOrFail($idrole_user);
        $userRole->update(['status' => $validated['status']]);

        $statusText = $validated['status'] == 1 ? 'Aktif' : 'Nonaktif';
        
        return redirect()->route('admin.role.index')
            ->with('success', "Status role berhasil diubah menjadi {$statusText}");
    }

    /**
     * Remove a role from a user.
     */
    public function removeRole($idrole_user)
    {
        $userRole = UserRole::findOrFail($idrole_user);
        
        // Cek apakah role ini masih digunakan di rekam medis
        $rekamMedisCount = \DB::table('rekam_medis')
            ->where('dokter_pemeriksa', $idrole_user)
            ->count();
            
        if ($rekamMedisCount > 0) {
            return redirect()->route('admin.role.index')
                ->with('error', "Role tidak bisa dihapus karena masih ada {$rekamMedisCount} rekam medis yang menggunakan role ini sebagai dokter pemeriksa");
        }
        
        // Cek apakah role ini masih digunakan di reservasi dokter
        $reservasiCount = \DB::table('reservasi_dokter')
            ->where('idrole_user', $idrole_user)
            ->count();
            
        if ($reservasiCount > 0) {
            return redirect()->route('admin.role.index')
                ->with('error', "Role tidak bisa dihapus karena masih ada {$reservasiCount} reservasi yang menggunakan role ini");
        }
        
        $userRole->delete();

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil dihapus dari user');
    }

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

    /**
     * Display a listing of all roles with CRUD operations.
     * Admin can add and delete roles here.
     */
    public function daftarRole()
    {
        // Check if table exists to prevent errors
        if (Schema::hasTable('role')) {
            $roles = Role::orderBy('idrole', 'asc')->get();
        } else {
            $roles = collect();
        }
        
        return view('admin.manajemen_role.daftar_role', compact('roles'));
    }

    /**
     * Store a newly created role.
     */
    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:50|unique:role,nama_role',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'nama_role.required' => 'Nama role wajib diisi',
            'nama_role.max' => 'Nama role maksimal 50 karakter',
            'nama_role.unique' => 'Nama role sudah ada',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter',
        ]);

        Role::create($validated);

        return redirect()->route('admin.role.daftar')
            ->with('success', 'Role baru berhasil ditambahkan');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroyRole(Role $role)
    {
        // Cek apakah role masih digunakan oleh user
        $userCount = $role->users()->count();
        
        if ($userCount > 0) {
            return redirect()->route('admin.role.daftar')
                ->with('error', "Role tidak bisa dihapus karena masih digunakan oleh {$userCount} user");
        }

        $role->delete();

        return redirect()->route('admin.role.daftar')
            ->with('success', 'Role berhasil dihapus');
    }
}
