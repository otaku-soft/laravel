<?php

namespace App\Observers;

use App\Models\ForumsCategories;
use App\Models\Permission;

class ForumsCategoriesObserver
{
    /**
     * Handle the ForumsCategories "created" event.
     */
    public function created(ForumsCategories $ForumsCategories): void
    {
        $permission = new Permission();
        $permission->name = "category_{$ForumsCategories->id}";
        $permission->guard_name = 'web';
        $permission->save();
    }

    /**
     * Handle the ForumsCategories "updated" event.
     */
    public function updated(ForumsCategories $ForumsCategories): void
    {
        //
    }

    /**
     * Handle the ForumsCategories "deleted" event.
     */
    public function deleted(ForumsCategories $ForumsCategories): void
    {
        //
    }

    /**
     * Handle the ForumsCategories "restored" event.
     */
    public function restored(ForumsCategories $ForumsCategories): void
    {
        //
    }

    /**
     * Handle the ForumsCategories "force deleted" event.
     */
    public function forceDeleted(ForumsCategories $ForumsCategories): void
    {
        //
    }
}
