<?php

namespace App\Http\Controllers;

use App\Models\{AboutContent, Program, Legality, Partner, TeamProfile, Sambutan, HistoryMilestone, LambangMeaning};

class AboutController extends Controller
{
    public function index()
    {
        $contents = AboutContent::pluck('content', 'section');
<<<<<<< HEAD
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
=======
        $sambutans = Sambutan::orderBy('urutan')->get();
        $historyMilestones = HistoryMilestone::orderBy('urutan')->get();
        $lambangMeanings = LambangMeaning::orderBy('urutan')->get()->groupBy('posisi');
        $programs = Program::all();
        $legalities = Legality::latest()->get();
        $partners = Partner::all();
        $teamByGroup = TeamProfile::orderBy('urutan')->get()->groupBy('tim');

        return view('about.index', compact(
            'contents', 'sambutans', 'historyMilestones', 'lambangMeanings',
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
            'programs', 'legalities', 'partners', 'teamByGroup'
        ));
    }
}