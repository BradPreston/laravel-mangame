<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class AnimeController extends Controller
{
    public function getTrendingAnime()
    {
        return Http::get('https://kitsu.io/api/edge/trending/anime?limit=12')->json();
    }

    public function getAnimeById(string $id)
    {
        $response = Http::get("https://kitsu.io/api/edge/anime/{$id}")->json();
        return Inertia::render('Anime/ID', [
            'anime' => $response
        ]);
    }
}
