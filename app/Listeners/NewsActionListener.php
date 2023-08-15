<?php

namespace App\Listeners;

use App\Events\NewsActionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\NewsLog;

class NewsActionListener
{
    public function __construct()
    {
        //
    }

    public function handle(NewsActionEvent $event)
    {
        // Create a log entry in the NewsLog table
        NewsLog::create([
            'user_id' => $event->user->id,
            'news_id' => $event->article->id,
            'action' => $event->action,
        ]);
    }
}
