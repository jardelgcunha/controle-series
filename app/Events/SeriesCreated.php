<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly string $seriesName,
        public readonly int $seriesId,
        public readonly int $seriesSeasonsQty,
        public readonly int $seriesEpisodesPerSeason,
    )
    {
    }
}
