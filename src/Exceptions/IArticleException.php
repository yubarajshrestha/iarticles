<?php
namespace YubarajShrestha\IArticles\Exceptions;
use Exception;
use YubarajShrestha\IArticles\FeedItem;

class IArticleException extends Exception
{
    public $subject;
    public static function notFeedable($subject)
    {
        return (new static('Object doesn\'t implement `YubarajShrestha\IArticles\InstantArticle`'))->withSubject($subject);
    }
    public static function notAFeedItem($subject)
    {
        return (new static('`toFeedItem` should return an instance of `YubarajShrestha\IArticles\InstantArticle`'))->withSubject($subject);
    }
    public static function missingField(FeedItem $subject, $field)
    {
        return (new static("Field `{$field}` is required"))->withSubject($subject);
    }
    protected function withSubject()
    {
        $this->subject;
        return $this;
    }
}