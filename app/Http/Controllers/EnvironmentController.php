<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentInfo;

class EnvironmentController extends Controller
{
    public function index()
    {
        $infos = EnvironmentInfo::latest()->get();
        return view('environment.index', compact('infos'));
    }
}