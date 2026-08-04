<?php

namespace App\Http\Controllers;

use App\Models\{Article, Product, AboutContent, Program, TeamProfile};

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Article::latest()->take(3)->get();
        $featuredProducts = Product::latest()->take(4)->get();
        $sambutan = AboutContent::where('section', 'sambutan')->first();
        $programs = Program::take(3)->get();

        $totalMembers = TeamProfile::count();
        $totalPrograms = Program::count();
        $totalProducts = Product::count();

        return view('home.index', compact(
            'latestArticles', 'featuredProducts', 'sambutan', 'programs',
            'totalMembers', 'totalPrograms', 'totalProducts'
        ));
    }
}