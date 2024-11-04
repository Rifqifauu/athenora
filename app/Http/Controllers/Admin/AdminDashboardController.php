<?php


namespace App\Http\Controllers\Admin; // Namespace sesuai dengan folder

use App\Http\Controllers\Controller; // Pastikan mengimport Controller dari namespace yang benar

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Mengarahkan ke tampilan dashboard admin
        return inertia('AdminDashboard'); // Pastikan path ini sesuai dengan struktur folder kamu
    }
}

