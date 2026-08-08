<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function show(Program $program)
    {
        $related = Program::where('id', '!=', $program->id)->latest()->take(3)->get();

        return view('programs.show', compact('program', 'related'));
    }
}