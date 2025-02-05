<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MangaController extends Controller
{
    public function getTrendingManga()
    {
        return Http::get('https://kitsu.io/api/edge/trending/manga?limit=12')->json();
    }
}
