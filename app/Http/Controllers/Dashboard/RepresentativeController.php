<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RepresentativeController extends Controller
{
    public function index()
    {
        return view('dashboard.representative.index');
    }
}
