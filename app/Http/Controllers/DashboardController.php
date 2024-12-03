<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi_count = \App\Models\Transaksi::count();
        return view('dashboard', compact('transaksi_count'));
    }
}

