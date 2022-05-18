<?php

namespace App\Http\Controllers;

use App\Models\Classificacao;
use App\Models\Imagem;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

use function PHPUnit\Framework\isNull;

class ClassificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $ocorrenciaid)
    {
        if(is_null($request->resolucao)
        // || is_null($request->caminho_img)
        || is_null($request->situacao)
        || is_null($ocorrenciaid)){
            echo "resolução: ".$request->resolucao."<br>";
            echo "situaçao: ".$request->situacao."<br>";
            echo "oc id: ".$ocorrenciaid."<br>";
            echo "vazio";
        }else{

            $verificacao = Ocorrencia::where("id",$ocorrenciaid)->update(["status"=>$request->situacao]);

            if($verificacao){
                $classificacao = new Classificacao();

                $classificacao->resolucao = $request->resolucao;
                $classificacao->freq = 0;
                $classificacao->ocorrencia_id = $ocorrenciaid;

                $classificacao->save();
                $classif_id = Classificacao::where('ocorrencia_id',$ocorrenciaid)->first();

                if(!is_null($request->caminho_img)){
                    $imagens_file=$request->file('caminho_img');
                    foreach($imagens_file as $img){
                        $imagens = new Imagem();
                        $caminho=$img->store("imgs-problemas");
                        echo $caminho;
                        $imagens->caminho_img = $caminho;
                        $imagens->classificacao_id = $classif_id->id;
                        $imagens->save();
                    }
                }
                return redirect()->route("adm.listar");
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classificacao  $classificacao
     * @return \Illuminate\Http\Response
     */
    // public function show(Classificacao $classificacao)
    public function show(Classificacao $classificacao)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classificacao  $classificacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Classificacao $classificacao)
    {
        $ocorrencia = Ocorrencia::where('id',$classificacao->ocorrencia_id)->first();
        $imagens = Imagem::all()->where('classificacao_id',$classificacao->id);

        if(empty(count($imagens))){
            return view('editDefinir',['ocorrencia'=>$ocorrencia,'classificacao'=>$classificacao]);
        }else{
            return view('editDefinir',['ocorrencia'=>$ocorrencia,'classificacao'=>$classificacao,'imagens'=>$imagens]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classificacao  $classificacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $ocorrenciaid)
    {
        $verifOcorrencia = Ocorrencia::where('id',$ocorrenciaid)->update(['status'=>$request->situacao]);
        if($verifOcorrencia){

            $verifClassificacoes = Classificacao::where('ocorrencia_id',$ocorrenciaid)->update(['resolucao'=>$request->resolucao,'freq'=>$request->freq]);
            if($verifClassificacoes){

                if(!is_null($request->caminho_img)){
                    $imagens_file=$request->file('caminho_img');

                    foreach($imagens_file as $img){
                        $imagens = new Imagem();
                        $caminho=$img->store("imgs-problemas");
                        echo $caminho;
                        $imagens->caminho_img = $caminho;
                        $Classif_id = Classificacao::where('ocorrencia_id',$ocorrenciaid)->value('id');
                        $imagens->classificacao_id = $Classif_id;
                        $imagens->save();
                    }
                }

                $ocorrencia = Ocorrencia::where('id',$ocorrenciaid)->first();
                return redirect()->route("adm.exibir",['ocorrencia'=>$ocorrencia]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classificacao  $classificacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classificacao $classificacao)
    {
        //
    }
}
