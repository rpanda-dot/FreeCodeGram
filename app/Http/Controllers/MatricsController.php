<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Raja\QuickMetrics\QuickMetrics;

class MatricsController extends Controller
{
    public function test()
    {
        return QuickMetrics::event('raja', 1.3);
    }
    //
}
