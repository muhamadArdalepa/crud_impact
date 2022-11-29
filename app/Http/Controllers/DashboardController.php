<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index')->with('title', 'Dashboard')->with('menu', 'dashboard');
    }
}
