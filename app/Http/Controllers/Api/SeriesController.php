<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SeriesApiFormRequest;
use App\Models\Series;
use Illuminate\Support\Facades\Log;

class SeriesController extends Controller
{
    public function index()
    {
        return Series::all();
    }

    public function store(SeriesApiFormRequest $request)
    {
        $validated = $request->validated();
        Log::info('Dados validados: ', $validated);
        Log::info('Cover no request: ' . $request->file('cover')?->getClientOriginalName());

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('series_cover', 'public');
            $validated['cover'] = $coverPath;
        }

        $series = Series::create($validated);

        // Verifica se foi enviado um arquivo no campo 'cover'
//        $coverPath = $request->hasFile('cover')
//            ? $request->file('cover')->store('series_cover', 'public') // Armazena a imagem na pasta 'storage/app/public/series_cover'
//            : null;

        // Adiciona o caminho da capa no request, para que seja salvo na série
//        $request->merge(['coverPath' => $coverPath]);
//
//        // Log para depuração - Verifique se o arquivo foi armazenado corretamente
//        Log::info('Cover Path: ' . $coverPath);
//
//        // Cria a série com os dados validados
//        $series = Series::create($request->validated());
//
//        // Log para depuração - Verifique os dados da série criada
//        Log::info('Serie Criada: ', $series->toArray());

        // Retorna a resposta com a série criada
        return response()->json([
            'message' => "Série '{$series->name}' foi cadastrada com sucesso!",
            'data' => $series
        ], 201);
    }
}
