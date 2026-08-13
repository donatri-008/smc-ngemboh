<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Program;

class SitemapController extends Controller
{
    public function index()
    {
        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0'],
            ['url' => route('articles.index'), 'priority' => '0.8'],
            ['url' => route('environment.index'), 'priority' => '0.7'],
            ['url' => route('demographic.index'), 'priority' => '0.7'],
            ['url' => route('shop.index'), 'priority' => '0.8'],
            ['url' => route('about.index'), 'priority' => '0.6'],
        ];

        // Article & Program pakai slug sebagai route key, Product pakai id — semuanya
        // otomatis terbaca benar oleh route() karena sudah diatur lewat getRouteKeyName().
        $articles = Article::latest()->get()->map(fn ($article) => [
            'url' => route('articles.show', $article),
            'lastmod' => $article->updated_at->toAtomString(),
            'priority' => '0.6',
        ]);

        $products = Product::latest()->get()->map(fn ($product) => [
            'url' => route('shop.show', $product),
            'lastmod' => $product->updated_at->toAtomString(),
            'priority' => '0.6',
        ]);

        $programs = Program::latest()->get()->map(fn ($program) => [
            'url' => route('program.show', $program),
            'lastmod' => $program->updated_at->toAtomString(),
            'priority' => '0.5',
        ]);

        $urls = collect($staticPages)->merge($articles)->merge($products)->merge($programs);

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }
}