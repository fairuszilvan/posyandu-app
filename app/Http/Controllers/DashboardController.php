<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the total number of patients
        $totalPatients = Pasien::count();
        $totalMalePatients = Pasien::where('jenis_kelamin', 'Laki-laki')->count();
        
        // Get total number of female patients
        $totalFemalePatients = Pasien::where('jenis_kelamin', 'Perempuan')->count();

        // Pass the data to the view
        return view('dashboard', compact('totalPatients','totalMalePatients','totalFemalePatients'));
    }
}
