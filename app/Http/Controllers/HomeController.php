<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //creamos la redireccion a la vista 
    public function Index()
    {
        return view('frontend.index');
        
    }
}
