<?php
namespace YubarajShrestha\IArticles;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use YubarajShrestha\IArticles\Exceptions\IArticleException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Arr;

class Article implements Responsable
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var string */
    protected $language = "en-us";

    /** @var string */
    protected $url;

    /** @var string */
    protected $brand;

    /** @var string */
    protected $view;

    /** @var \Illuminate\Support\Collection */
    protected $items;

    public function __construct($feed, $url, $resolver, $view)
    {
        $this->title = $feed['title'];
        $this->brand = $feed['brand'];
        $this->description = $feed['description'];
        $this->language = $feed['lang'];
        $this->brand = $feed['brand'];
        $this->url = $url;
        $this->view = $view;
        $this->items = $this->resolveItems($resolver);
    }

    public function toResponse($request): Response
    {
        $meta = [
            'title' => $this->title,
            'brand' => $this->brand,
            'link' => url($this->url),
            'description' => $this->description,
            'language' => $this->language,
            'updated' => $this->lastUpdated(),
        ];

        $contents = view($this->view, [
            'meta' => $meta,
            'items' => $this->items,
        ]);

        return new Response($contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
        ]);
    }

    protected function resolveItems($resolver): Collection
    {
        $resolver = Arr::wrap($resolver);
        $items = app()->call(
            array_shift($resolver), $resolver
        );
        return collect($items)->map(function ($instantArticle) {
            return $this->castToFeedItem($instantArticle);
        });
    }

    protected function castToFeedItem($instantArticle): Articles
    {
        if (is_array($instantArticle)) {
            $instantArticle = new Articles($instantArticle);
        }
        if ($instantArticle instanceof Articles) {
            $instantArticle->validate();
            return $instantArticle;
        }
        if (! $instantArticle instanceof InstantArticle) {
            throw IArticleException::notFeedable($instantArticle);
        }
        $feedItem = $instantArticle->iArticle();
        if (! $feedItem instanceof Articles) {
            throw IArticleException::notAFeedItem($feedItem);
        }
        $feedItem->validate();
        return $feedItem;
    }

    protected function lastUpdated(): string
    {
        if ($this->items->isEmpty()) {
            return '';
        }
        return $this->items->sortBy(function ($feedItem) {
            return $feedItem->updated;
        })->last()->updated->toRfc822String();
    }

}
