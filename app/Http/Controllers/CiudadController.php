<?php

namespace App\Http\Controllers;

use App\Models\ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    //
    public function index()
    {
        $ciudads = ciudad::with('pais')->get();
        return view('ciudads.index', compact('ciudads'));
    }
}
