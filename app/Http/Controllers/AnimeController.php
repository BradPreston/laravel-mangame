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

    public function getAllAnime(Request $request)
    {
        $limit = $request->query('limit');
        if (!isset($limit)) {
            $limit = 9;
        }
        $page = $request->query('page');
        if (!isset($page)) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        if ($limit && $page) {
            $query = "?page[limit]={$limit}&page[offset]={$offset}}";
        } else if ($page) {
            $query = "?page[limit]=9&page[offset]={$offset}}";
        } else if ($limit) {
            $query = "?page[limit]={$limit}";
        }
        $response = Http::get("https://kitsu.io/api/edge/anime?page[limit]=9")->json();
        if (isset($query)) {
            $response = Http::get("https://kitsu.io/api/edge/anime{$query}")->json();
        }
        return Inertia::render('Anime/Index', [
            'anime' => $response,
            'limit' => (int)$limit,
            'page' => (int)$page,
            'offset' => (int)$offset
        ]);
    }
}
