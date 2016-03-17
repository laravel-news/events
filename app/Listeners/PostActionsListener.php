<?php

namespace App\Listeners;

use App\Events\Event;
use App\Events\PostPublished;
use App\Events\PostPublishedEvent;
use App\Handlers\OneSignalHandler;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostActionsListener implements ShouldQueue
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
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
        if ($event instanceof PostPublishedEvent)
        {
            OneSignalHandler::sendNotify($event->post);
        }
    }
}
