<?php

namespace App\Observers;

use App\Models\forums_categories;
use App\Models\Permission;

class ForumsCategoriesObserver
{
    /**
     * Handle the forums_categories "created" event.
     */
    public function created(forums_categories $forums_categories): void
    {
        $permission = new Permission();
        $permission->name = "category_{$forums_categories->id}";
        $permission->guard_name = 'web';
        $permission->save();
    }

    /**
     * Handle the forums_categories "updated" event.
     */
    public function updated(forums_categories $forums_categories): void
    {
        //
    }

    /**
     * Handle the forums_categories "deleted" event.
     */
    public function deleted(forums_categories $forums_categories): void
    {
        //
    }

    /**
     * Handle the forums_categories "restored" event.
     */
    public function restored(forums_categories $forums_categories): void
    {
        //
    }

    /**
     * Handle the forums_categories "force deleted" event.
     */
    public function forceDeleted(forums_categories $forums_categories): void
    {
        //
    }
}
