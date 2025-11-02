<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    
public function showLoginForm()
{
    if (Auth::check()) {
        return redirect()->route('home')->with('info', 'Anda sudah login, silakan logout dulu untuk login sebagai user lain.');
    }
    return view('auth.login');
}

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $users = User::with(["roles" => function ($query) {
            $query->where("status", 1);
        }])
            ->where("email", $request->input("email"))
            ->first();
        
        if (!$users) {
            return redirect()->back()
                ->withErrors(["email" => "Email tidak ditemukan"])
                ->withInput();
        }
        
        // Cek password
        if (!Hash::check($request->input("password"), $users->password)) {
            return redirect()->back()
                ->withErrors(["password" => "Password salah"])
                ->withInput();
        }

        // Ambil role pertama user
        $userRole = $users->roles->first();
        
        if (!$userRole) {
            return redirect()->back()
                ->withErrors(["email" => "User tidak memiliki role"])
                ->withInput();
        }

        //Login user ke session 
        Auth::login($users);

        //simpan session user 
        $request->session()->put([
            'user_id' => $users->iduser,
            'user_name' => $users->nama,
            'user_email' => $users->email,
            'user_role' => (int) $userRole->idrole,
            'user_role_name' => $userRole->nama_role,
            'user_status' => $userRole->pivot->status ?? 'active',
        ]);

        $roleId = (int) $userRole->idrole;

        switch ($roleId) {
            case 1: // Administrator
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            case 2: // Dokter
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil');
            case 3: // Perawat
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil');
            case 4: // Resepsionis
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil');
            case 5: // Pemilik
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil');
            default:
                return redirect()->route('home')->with('error', 'Role tidak valid');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout');
    }
    
    
}
