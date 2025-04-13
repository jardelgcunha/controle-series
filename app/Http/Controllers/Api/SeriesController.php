<?php

namespace App\Http\Controllers\Api;

use App\Events\SeriesCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $series = Series::whereId($series)
            ->with('seasons')
            ->first();
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
}
