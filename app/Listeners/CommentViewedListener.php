<?php

namespace App\Listeners;

use App\Events\CommentViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;

class CommentViewedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        broadcast(new CommentViewed($event->ticketId, $event->userId))->toOthers('ticket.'.$event->ticketId.'.comments');
    }
}
