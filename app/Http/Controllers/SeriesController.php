<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DeleteSeriesCover;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        parent::__construct();
        $this->middleware(Autenticador::class)->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)->withMensagemSucesso($mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : null;
        $request->coverPath = $coverPath;
        $series = $this->repository->add($request);

        $seriesCreatedEvent = new SeriesCreated(
          $series->name,
          $series->id,
          $request->seasonsQty,
          $request->episodesPerSeason,
        );
        event($seriesCreatedEvent);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->name}' foi cadastrada com sucesso!");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        if ($series->cover) {
            DeleteSeriesCover::dispatch($series->cover);
        }

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->name}' foi removida com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
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

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->name}' foi atualizada com sucesso!");
    }
}
