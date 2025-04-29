<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $seriesRepository)
    {
        parent::__construct();
    }

    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : null;

        $request->coverPath = $coverPath;
        $series = $this->seriesRepository->add($request);

        return response()->json([
            'message' => "Série '{$series->name}' foi cadastrada com sucesso!",
            'data' => $series
        ], 201);
    }

    public function show(int $series)
    {
        $series = Series::find($series);
        if ($series === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }
        return $series;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        if ($request->hasFile('cover')) {
            if ($series->cover) {
                Storage::disk('public')->delete($series->cover);
            }

            $coverPath = $request->file('cover')->store('series_cover', 'public');
            $series->cover = $coverPath;
        }
        $series->fill($request->except('cover'))->save();

//        return $series;
        return response()->json([
            'message' => "Série '{$series->name}' foi atualizada com sucesso!",
            'data' => $series
        ], 200);
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->json([
            'message' => "A série foi removida com sucesso!",
        ], 200);
    }

    public function getEpisodes(Series $series)
    {
        return $series->episodes;
    }
}
