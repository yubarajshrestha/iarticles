<?php
namespace YubarajShrestha\IArticles;

interface InstantArticle
{
    /**
     * @return array|\YubarajShresth\IArticles\FeedItem
     */
    public function feedItem();
}
