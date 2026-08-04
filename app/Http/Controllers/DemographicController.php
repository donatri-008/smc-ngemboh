<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;

class DemographicController extends Controller
{
    public function index()
    {
        $stats = Statistic::where('type', 'demografi')
            ->orderBy('tahun')
            ->get()
            ->groupBy('kategori');

        return view('demographic.index', compact('stats'));
    }
}
