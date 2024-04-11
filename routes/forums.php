<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Routes\UrlBuilder;
$url = new UrlBuilder("/forum");
Route::get($url->url(""), [ForumController::class, 'index']);
Route::get($url->url("/topicList/{category_id}"), [ForumController::class, 'topicList'])->name("forum_topicList");
Route::get($url->url("/createForumSections"), [ForumController::class, 'createForumSections']);


Route::middleware('auth')->group(function () {
    $url = new UrlBuilder("/forum");
    Route::get($url->url("/addTopic/{categoryId}"), [ForumController::class, 'addTopic'])->name("forum_addTopic");
    Route::post($url->url("/addTopicSaved"), [ForumController::class, 'addTopicSaved'])->name("forum_addTopicSaved");
});
