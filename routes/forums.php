<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Routes\UrlBuilder;
$url = new UrlBuilder("/forum");
Route::get($url->url(""), [ForumController::class, 'index']);
Route::get($url->url("/topicList/{category_id}"), [ForumController::class, 'topicList']);
Route::get($url->url("/createForumSections"), [ForumController::class, 'createForumSections']);
