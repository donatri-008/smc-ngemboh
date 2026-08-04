<?php

namespace App\Http\Controllers;

use App\Models\{AboutContent, Program, Legality, Partner, TeamProfile};

class AboutController extends Controller
{
    public function index()
    {
        $contents = AboutContent::pluck('content', 'section');
        $programs = Program::all();
        $legalities = Legality::latest()->get();
        $partners = Partner::all();
        $teamByGroup = TeamProfile::orderBy('urutan')->get()->groupBy('tim');

        return view('about.index', compact('contents', 'programs', 'legalities', 'partners', 'teamByGroup'));
    }
}
