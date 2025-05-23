<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSeriesCreated implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(SeriesCreated $event)
    {
        Log::info("Série {$event->seriesName} criada com sucesso");
    }
}
