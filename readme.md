# Modularizing Laravel

[![GitHub stars](https://img.shields.io/github/stars/yubarajshrestha/laravel-module.svg)](https://github.com/yubarajshrestha/iarticles/stargazers)
[![Latest Stable Version](https://poser.pugx.org/yubarajshrestha/ym/v/stable)](https://packagist.org/packages/yubarajshrestha/articles)
[![Total Downloads](https://poser.pugx.org/yubarajshrestha/articles/downloads)](https://packagist.org/packages/yubarajshrestha/articles)
[![License](https://poser.pugx.org/yubarajshrestha/articles/license)](https://packagist.org/packages/yubarajshrestha/articles)

**If you are sick trying to findout the controllers, routes and views from too many project files in laravel then yes, this package is for you.**

> This helps you to organize your Laravel Project codes by modularizing all your controllers, views and models. This will be very helpful when your laravel project is very big.

### How to?
#### Step 1: Install package

Install package by executing the command.

```
composer require yubarajshrestha/iarticles
```

#### Step 2: Publish Vendor Files
You need to have some files and don't worry it's quite easy. You just want to execute the command now.

`php artisan vendor:publish --tag=iarticles`

#### Step 3: Update Configurations
You need to define options in your `iarticles` configuration file. You'll find default options from where you will get an idea on how to configure things.

#### Step 4: Implement Instant Article Interface to your Model and configure as follows
```
use YubarajShrestha\IArticles\InstantArticle;
use YubarajShrestha\IArticles\Articles;
class YourModel implements InstantArticle {


	/** 
	 * Instant Article
	 * @return Collection of YourModel
	 */
    public static function getFeedItems()
    {
        return YourModel::latest()->get()->take(25);
    }

    /** 
     * Filter Feed Data
     * @return iArticle Object
     */
    public function iArticle()
    {
        return Articles::create([
            'id' => $this->id, // required | integer
            'title' => $this->name, // required | string
            'subtitle' => '', // nullable | string
            'kicker' => $this->kicker, // nullable | string
            'summary' => '', // required | string
            'description' => '', // required | string
            'cover' => '', // nullable | string
            'updated' => '', // required | date
            'published' => Carbon::parse($this->created_at), // required | date
            'link' => '', // full url to item...
            'author' => '' // nullable | email | string
        ]);
    }
}
```

#### Step 5: Awesome
1. Your project is now ready to go :+1:.