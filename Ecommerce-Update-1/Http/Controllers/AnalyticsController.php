<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{

    public function content()
    {
        return view('analytics.content');
    }

}

