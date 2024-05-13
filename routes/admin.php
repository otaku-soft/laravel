<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ForumCreatorController;
use App\Routes\UrlBuilder;
Route::middleware('auth')->group(function () {
    $url = new UrlBuilder("/admin/forumCreator");
    Route::get($url->url(""), [ForumCreatorController::class, 'index'])->name("forumCreator_index");
    Route::post($url->url("/addSection"), [ForumCreatorController::class, 'addSection'])->name("forumCreator_addSection");
    Route::post($url->url("/reorderSections"), [ForumCreatorController::class, 'reorderSections'])->name("forumCreator_reorderSections");
    Route::post($url->url("/editModal"), [ForumCreatorController::class, 'editModal'])->name("forumCreator_editModal");
    Route::post($url->url("/editSection"), [ForumCreatorController::class, 'editSection'])->name("forumCreator_editSection");
    Route::post($url->url("/deleteSectionModal"), [ForumCreatorController::class, 'deleteSectionModal'])->name("forumCreator_deleteSectionModal");
    Route::post($url->url("/deleteSection"), [ForumCreatorController::class, 'deleteSection'])->name("forumCreator_deleteSection");

});
