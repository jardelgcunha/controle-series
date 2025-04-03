<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    public function test_series_creation_with_seasons_and_episodes()
    {
        DB::beginTransaction();

        try {
            // Arrange
            /** @var SeriesRepository $repository */
            $repository = $this->app->make(SeriesRepository::class);
            $request = new SeriesFormRequest();
            $request->name = 'Loki';
            $request->seasonQty = 2;
            $request->episodesPerSeason = 10;

            // Act
            $repository->add($request);

            // Assert
            $this->assertDatabaseHas('series', ['name' => 'Loki']);
            $this->assertDatabaseHas('seasons', ['number' => 2]);
            $this->assertDatabaseHas('episodes', ['number' => 10]);

        } finally {
            DB::rollBack();
        }
    }
}
