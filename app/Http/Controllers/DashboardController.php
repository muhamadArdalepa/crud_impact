<?php

namespace App\Http\Controllers;

use App\Models\Char;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index')->with('title', 'Dashboard')->with('menu', 'dashboard');
    }
}
