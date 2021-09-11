<?php
namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Serie;
use App\Services\{CriadorDeSerie, RemovedorDeSerie};
use App\{Temporada, Episodio};
use Illuminate\Support\Facades\Auth;

/*
Nome index = Função principal quando acessar /series
*/

class SeriesController extends Controller {
    /* View inicial, que lista as séries */

    /* Precisa estar logado pra acessar esse controller */
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function index(Request $request) {

        $series = Serie::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    /* View página Create */

    public function create() {
        return view('series.create');
    }

    /* Insere uma Série */

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie) {
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);

        $request->session()
            ->flash(
                'mensagem',
                "A série {$serie->nome} com {$request->qtd_temporadas} temporadas e {$request->ep_por_temporada} episódios criados com sucesso."
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie) {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()->flash('mensagem', "Série {$nomeSerie} foi removida com sucesso!");
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request) {
        $novoNome = $request->nome;
        $serie = Serie::find($request->id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
?>
