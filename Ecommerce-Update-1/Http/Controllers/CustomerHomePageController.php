<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerHomePageController extends Controller
{
    public function index()
    {         
        return view('customershomepage.index');
    }  
}
