<<<<<<< HEAD
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
=======
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
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
}