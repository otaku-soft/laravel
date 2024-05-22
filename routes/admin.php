<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ForumCreatorController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Middleware\AuthAdmin;
use App\Routes\UrlBuilder;

Route::middleware(AuthAdmin::class)->group(function ()
{
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
    $urlRoles = new UrlBuilder("/admin/roles/");
    Route::get($urlRoles->url(""), [RolesController::class, 'index'])->name("roles_index");
    Route::post($urlRoles->url("/addRole"), [RolesController::class, 'addRole'])->name("roles_addRole");
    Route::post($urlRoles->url("/editRoleModal"), [RolesController::class, 'editRoleModal'])->name("roles_editRoleModal");
    Route::post($urlRoles->url("/editRole"), [RolesController::class, 'editRole'])->name("roles_editRole");
    Route::post($urlRoles->url("/setForumPermissions"), [RolesController::class, 'setForumPermissions'])->name("roles_setForumPermissions");
    Route::post($urlRoles->url("/setForumPermissionsSave"), [RolesController::class, 'setForumPermissionsSave'])->name("roles_setForumPermissionsSave");
    $urlUsers = new UrlBuilder("/admin/users/");
    Route::get($urlUsers->url(""), [UsersController::class, 'index'])->name("users_index");
    Route::post($urlUsers->url("/editModal"), [UsersController::class, 'editModal'])->name("users_editModal");
    Route::post($urlUsers->url("/edit"), [UsersController::class, 'edit'])->name("users_edit");
});
