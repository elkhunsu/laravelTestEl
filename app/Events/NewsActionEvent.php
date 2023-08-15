<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsActionEvent
{
    use Dispatchable, SerializesModels;

    public $article;
    public $user;
    public $action;

    public function __construct(Article $article, User $user, $action)
    {
        $this->article = $article;
        $this->user = $user;
        $this->action = $action;
    }
}
