<?php

    Route::get('iarticles', 'YubarajShrestha\IArticles\Controllers\IArticleController@index');
    Route::get('iarticles/{model}', 'YubarajShrestha\IArticles\Controllers\IArticleController@feeds');