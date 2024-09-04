<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcaraController extends Controller
{
    public function index(Request $request)
    {
        return view('acara.index');
    }
}
