<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temporada;
use App\Episodio;
use App\Serie;

class EpisodiosController extends Controller
{
    public function index(int $serieId, Temporada $temporada, Request $request) {
       $episodios = $temporada->episodios;
       $temporadaId = $temporada->id;
       $mensagem = $request->session()->get('mensagem');
       $serie = Serie::find($serieId);
       return view('episodios.index', compact('episodios', 'temporadaId', 'mensagem', 'serie'));
    }

    public function assistir(int $serieId, Temporada $temporada, Request $request) {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });

        $temporada->push();

        $request->session()->flash('mensagem', 'Episódios salvos como assistidos');

        return redirect()->back();
    }
}
