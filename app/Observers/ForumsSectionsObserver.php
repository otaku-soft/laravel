<?php

namespace App\Observers;

use App\Models\ForumsSections;
use App\Models\Permission;

class ForumsSectionsObserver
{
    /**
     * Handle the ForumsSections "created" event.
     */
    public function created(ForumsSections $ForumsSections): void
    {
        $permission = new Permission();
        $permission->name = "section_{$ForumsSections->id}";
        $permission->guard_name = 'web';
        $permission->save();
    }

    /**
     * Handle the ForumsSections "updated" event.
     */
    public function updated(ForumsSections $ForumsSections): void
    {
        //
    }

    /**
     * Handle the ForumsSections "deleted" event.
     */
    public function deleted(ForumsSections $ForumsSections): void
    {
        //
    }

    /**
     * Handle the ForumsSections "restored" event.
     */
    public function restored(ForumsSections $ForumsSections): void
    {
        //
    }

    /**
     * Handle the ForumsSections "force deleted" event.
     */
    public function forceDeleted(ForumsSections $ForumsSections): void
    {
        //
    }
}
