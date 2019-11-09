<?php

namespace YubarajShrestha\IArticles\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use YubarajShrestha\IArticles\Article;

class IArticleController extends Controller
{

    public function index() {
        return view('iarticles::index');
    }

    public function feeds(Request $request, $slug) {
        $iarticles = config('iarticles');
        $keys = array_keys($iarticles);
        if(!in_array($slug, $keys)) return view('iarticles::index');
        $feed = $iarticles[$slug];
        abort_unless($feed, 404);
        return new Article($feed, request()->url(), $feed['items'], $feed['view'] ?? 'iarticles::feed');
    }

    public function feed() {
        $feed = config('iarticles.feeds')['main'];
        abort_unless($feed, 404);
        return new Article($feed, request()->url(), $feed['items'], $feed['view'] ?? 'iarticles::feed');
    }

}
