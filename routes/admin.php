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
    $urlCategory = new UrlBuilder("/admin/forumCreator/category/");
    Route::get($urlCategory->url("{section_id}"), [ForumCreatorController::class, 'categoryIndex'])->name("forumCreator_categoryIndex");
    Route::post($urlCategory->url("orderCategories"), [ForumCreatorController::class, 'orderCategories'])->name("forumCreator_orderCategories");
    Route::post($urlCategory->url("addCategory"), [ForumCreatorController::class, 'addCategory'])->name("forumCreator_addCategory");
    Route::post($urlCategory->url("/editCategoryModal"), [ForumCreatorController::class, 'editCategoryModal'])->name("forumCreator_editCategoryModal");
    Route::post($urlCategory->url("/editCategory"), [ForumCreatorController::class, 'editCategory'])->name("forumCreator_editCategory");
    Route::post($urlCategory->url("/deleteCategoryModal"), [ForumCreatorController::class, 'deleteCategoryModal'])->name("forumCreator_deleteCategoryModal");
    Route::post($urlCategory->url("/deleteCategory"), [ForumCreatorController::class, 'deleteCategory'])->name("forumCreator_deleteCategory");
});
