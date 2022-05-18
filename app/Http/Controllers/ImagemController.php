<?php

namespace App\Http\Controllers;

use App\Models\Classificacao;
use App\Models\Imagem;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagemController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imagem  $imagem
     * @return \Illuminate\Http\Response
     */
    public function show(Imagem $imagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imagem  $imagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagem $imagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imagem  $imagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imagem $imagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imagem  $imagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imagem $imagem)
    {
        $storageImg = Imagem::where("id",$imagem->id)->first();

        $verif = Imagem::where('id',$imagem->id)->delete();
        // $verif= true;
        if($verif){
            Storage::delete($storageImg->caminho_img);

            echo $storageImg->classificacao;
            $classificacao = Classificacao::where('id',$storageImg->classificacao_id)->first();
            $ocorrencia = Ocorrencia::where('id',$classificacao->ocorrencia_id)->first();
            $imagens = Imagem::all()->where('classificacao_id',$classificacao->id);

            if(empty(count($imagens))){
                return redirect()->route('adm.editar',['ocorrencia'=>$ocorrencia,'classificacao'=>$classificacao]);
            }else{
                return redirect()->route('adm.editar',['ocorrencia'=>$ocorrencia,'classificacao'=>$classificacao,'imagens'=>$imagens]);
            }
        }else{
            echo "erro ao deletar imagem".$imagem->id;
        }
    }
}
