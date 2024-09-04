<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnakController extends Controller
{
    public function index()
    {
        return view('anak.index');
    }
}
