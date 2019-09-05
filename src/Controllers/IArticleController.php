<?php

namespace YubarajShrestha\IArticles\Controllers;

use App\Http\Controllers\Controller;
use YubarajShrestha\IArticles\Feed;

class IArticleController extends Controller
{
    public function feeds() {
        $feed = config('feed.feeds')['main'];
        abort_unless($feed, 404);
        return new Feed($feed['title'], $feed['description'], $feed['lang'], request()->url(), $feed['items'], $feed['view'] ?? 'feed::feed');
    }
}
