<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request) : Series
    {
        return DB::transaction(function () use ($request) {
            $series = Series::create([
                'name' => $request->name,
                'cover' => $request->coverPath,
            ]);
            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($series->seasons as $season) {
                for ($i = 1; $i <= $request->episodesPerSeason; $i++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $i,
                    ];
                }
            }
            Episode::insert($episodes);

            return $series;
        });
    }
}
