<?php

namespace App\Http\Controllers;

use App\Models\DemographicEntry;

class DemographicController extends Controller
{
    public function index()
    {
        $summary = DemographicEntry::summary();
        $anggotaSmcCount = $summary['anggota_smc']['value'] ?? 0;

        return view('demographic.index', compact('summary', 'anggotaSmcCount'));
    }
}