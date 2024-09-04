<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }
}
