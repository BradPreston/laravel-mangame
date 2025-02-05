<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    public function getTrendingAnime()
    {
        return Http::get('https://kitsu.io/api/edge/trending/anime?limit=12')->json();
    }
}
