<?php

namespace YubarajShrestha\IArticles;

use Exception;
use Carbon\Carbon;
use YubarajShrestha\IArticles\Exceptions\IArticleException;

class FeedItem
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $title;

    /** @var string */
    protected $summary;

    /** @var string */
    protected $description;

    /** @var @var string */
    protected $link;

    /** @var string */
    protected $author;

    /** @var \Carbon\Carbon */
    protected $updated;

    /** @var \Carbon\Carbon */
    protected $published;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function create(array $data = [])
    {
        return new static($data);
    }

    public function id(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function published(Carbon $published)
    {
        $this->published = $published;
        return $this;
    }

    public function updated(Carbon $updated)
    {
        $this->updated = $updated;
        return $this;
    }

    public function description(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function link(string $link)
    {
        $this->link = $link;
        return $this;
    }

    public function author(string $author)
    {
        $this->author = $author;
        return $this;
    }

    public function validate()
    {
        $requiredFields = ['id', 'title', 'updated', 'summary', 'description', 'published', 'link', 'author'];
        foreach ($requiredFields as $requiredField) {
            if (is_null($this->$requiredField)) {
                throw IArticleException::missingField($this, $requiredField);
            }
        }
    }

    public function __get($key)
    {
        if (! isset($this->$key)) {
            throw new Exception("Property `{$key}` doesn't exist");
        }
        return $this->$key;
    }
}