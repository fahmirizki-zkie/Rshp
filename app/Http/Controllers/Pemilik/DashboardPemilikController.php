<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardPemilikController extends Controller
{
    private $pemilikController;

    public function __construct(PemilikController $pemilikController)
    {
        $this->pemilikController = $pemilikController;
    }

    /**
     * Display dashboard pemilik with summary data
     */
    public function index()
    {
        // Cek apakah user sudah login dan role-nya pemilik (role 4)
        if (!session('user_id') || session('user_role') != 4) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login sebagai pemilik terlebih dahulu');
        }

        // Get summary data from PemilikController
        $summaryData = $this->pemilikController->getSummaryData();

        // If getSummaryData returns redirect, handle it
        if ($summaryData instanceof \Illuminate\Http\RedirectResponse) {
            return $summaryData;
        }

        return view('pemilik.dashboard_pemilik', $summaryData);
    }
}
