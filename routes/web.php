<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $categories = DB::select('select * from ForumCategories');

    foreach ($categories as $category) {
        echo $category->name."2<br/>";
        echo $category->description."<br/>";
    }


    return view('welcome');
});
