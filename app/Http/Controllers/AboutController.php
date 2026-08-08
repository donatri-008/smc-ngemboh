<?php

namespace App\Http\Controllers;

use App\Models\{AboutContent, Program, Legality, Partner, TeamProfile, Sambutan, HistoryMilestone, LambangMeaning};

class AboutController extends Controller
{
    public function index()
    {
        $contents = AboutContent::pluck('content', 'section');
        $images = AboutContent::pluck('image', 'section');

        $sambutans        = Sambutan::orderBy('urutan')->get();
        $historyMilestones = HistoryMilestone::orderBy('urutan')->get();
        $lambangMeanings   = LambangMeaning::orderBy('urutan')->get()->groupBy('posisi');
        $programs          = Program::all();
        $legalities        = Legality::latest()->get();
        $partners          = Partner::all();
        $teamByGroup       = TeamProfile::orderBy('urutan')->get()->groupBy('tim');

        return view('about.index', compact(
            'contents', 'images', 'sambutans', 'historyMilestones', 'lambangMeanings',
            'programs', 'legalities', 'partners', 'teamByGroup'
        ));
    }
}