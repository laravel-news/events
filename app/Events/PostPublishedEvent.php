<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Post;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostPublishedEvent extends Event
{
    use SerializesModels;

    public $post;

    /**
     * PostPublishedEvent constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
