<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{EnvironmentInfo, Statistic};

class EnvironmentController extends Controller
{
    public function index()
    {
        $infos = EnvironmentInfo::latest()->get();
        $stats = Statistic::where('type', 'lingkungan')
            ->orderBy('tahun')
            ->get()
            ->groupBy('kategori');

        return view('environment.index', compact('infos', 'stats'));
    }
}
