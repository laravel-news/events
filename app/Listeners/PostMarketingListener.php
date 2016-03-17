<?php

namespace App\Listeners;

use App\Events\PushSentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostMarketingListener
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
     * @param  PushSentEvent  $event
     * @return void
     */
    public function handle(PushSentEvent $event)
    {
        $event->post->recordPushNotifySuccess();
    }
}
