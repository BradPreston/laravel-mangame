<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $anime = new AnimeController();
        $trendingAnime = $anime->getTrendingAnime();

        $manga = new MangaController();
        $trendingManga = $manga->getTrendingManga();
        return Inertia::render('Welcome', [
            'trendingAnime' => $trendingAnime,
            'trendingManga' => $trendingManga
        ]);
    }
}
