<?php

namespace App\Observers;

use App\Models\forums_sections;
use App\Models\Permission;

class ForumsSectionsObserver
{
    /**
     * Handle the forums_sections "created" event.
     */
    public function created(forums_sections $forums_sections): void
    {
        $permission = new Permission();
        $permission->name = "section_{$forums_sections->id}";
        $permission->guard_name = 'web';
        $permission->save();
    }

    /**
     * Handle the forums_sections "updated" event.
     */
    public function updated(forums_sections $forums_sections): void
    {
        //
    }

    /**
     * Handle the forums_sections "deleted" event.
     */
    public function deleted(forums_sections $forums_sections): void
    {
        //
    }

    /**
     * Handle the forums_sections "restored" event.
     */
    public function restored(forums_sections $forums_sections): void
    {
        //
    }

    /**
     * Handle the forums_sections "force deleted" event.
     */
    public function forceDeleted(forums_sections $forums_sections): void
    {
        //
    }
}
