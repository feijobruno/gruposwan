<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard
    public function index()
    {
        // Carregar a VIEW
        return view('dashboard.index', ['menu' => 'dashboard']);
    }

    public function legalNotice()
    {
        return view('dashboard.legalNotice', ['menu' => 'dashboard']); 
    }

    public function privacyPolicy()
    {
        return view('dashboard.privacyPolicy', ['menu' => 'dashboard']); 
    }

    public function cookies()
    {
        return view('dashboard.cookies', ['menu' => 'dashboard']); 
    }
}
