<?php

namespace App\Http\Controllers;

use App\Models\Classificacao;
use App\Models\Imagem;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\isEmpty;

class OcorrenciaController extends Controller
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
    public function store(Request $request)
    {


        if(is_null($request->input('nome'))
        || is_null($request->input('setor'))
        || is_null($request->input('categoria'))
        || is_null($request->input('ocorrido'))){
            echo "vazio";
        }else{
            $ocorrencia = new Ocorrencia();
            $ocorrencia->nome = $request->input('nome');
            $ocorrencia->setor = $request->input('setor');
            $ocorrencia->categoria = $request->input('categoria');
            $ocorrencia->ocorrido = $request->input('ocorrido');
            $ocorrencia->status = 0;
            $ocorrencia->save();
        }
        return redirect()->route('adm.listar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        ///alterar numero exibido por pagina na lista
        $ocorrencia = Ocorrencia::orderBy('id','desc')->simplePaginate(10);
        $arrayclassificacao[]=array();

        foreach($ocorrencia as $oc){
            $freq = Classificacao::where('ocorrencia_id',$oc->id)->value('freq');

            if(is_null($freq)){
            $arrayclassificacao[$oc->id]=0;
            }else{
            $arrayclassificacao[$oc->id]=$freq;
            }
        }
        return view('listar',['ocorrencia'=>$ocorrencia,'arrayClassificacao'=>$arrayclassificacao]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Ocorrencia $ocorrencia)
    {

        $classificacao = Classificacao::where('ocorrencia_id',$ocorrencia->id)->first();

        if(is_null($classificacao)){
            return view('editDefinir',['ocorrencia'=>$ocorrencia]);
        }else{
            $imagens = Imagem::all()->where('classificacao_id',$classificacao->id);

            if(empty(count($imagens))){
                return view('definir',['ocorrencia'=>$ocorrencia,'classificacao'=>$classificacao]);
            }else{
                return view('definir',['ocorrencia'=>$ocorrencia,'classificacao'=>$classificacao,'imagens'=>$imagens]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ocorrencia $ocorrencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ocorrencia $ocorrencia)
    {
        if(!empty($ocorrencia)){

            $classificacao = Classificacao::where('ocorrencia_id',$ocorrencia->id)->first();
            if($ocorrencia->delete()){

                if(!empty($classificacao)){

                    $imagens = Imagem::all()->where('classificacao_id',$classificacao->id);
                    if($classificacao->delete()){
                        if(!empty(count($imagens))){
                            foreach($imagens as $img){
                                Storage::delete($img->caminho_img);
                                $img->delete();
                            }
                            return redirect()->route("adm.listar");
                        }else{
                            // echo"Imagens vazio";
                            return redirect()->route("adm.listar");
                        }
                    }else{echo"Erro ao deletar classificação";}
                }else{
                    // echo"Classificação vazio";
                    return redirect()->route("adm.listar");
                }
            }else{echo"Erro ao deletar ocorrencia";}
        }else{
            // echo"Ocorencia vazio";
            return redirect()->route("adm.listar");
        }
    }

    public function pesquisar(Request $request){
        $arrayclassificacao[]=array();
        $ocorrencia = Ocorrencia::where('categoria','LIKE',"%{$request->pesquisar}%");
        $ocorrencia = $ocorrencia->simplePaginate(10);
        $ocorrencia->appends(['pesquisar'=>$request->pesquisar]);

        foreach($ocorrencia as $oc){
            $freq = Classificacao::where('ocorrencia_id',$oc->id)->value('freq');
            if(is_null($freq)){
                $arrayclassificacao[$oc->id]=0;
             }else{
                $arrayclassificacao[$oc->id]=$freq;
             }
        }
        return view("listar",['ocorrencia'=>$ocorrencia,'arrayClassificacao'=>$arrayclassificacao]);
    }
}
