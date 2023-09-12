<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ControllerFilme extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mostrar()
    {
        //GET

        $DadoGet = Filme::all();
         return 'Dados achados:'.$DadoGet;    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cadastrar(Request $request)
    {
        //Cadastrar

        $buxarFilmes = $request->all();
        $validador = Validator::make($buxarFilmes,[
            'nome' => 'required',
            'genero' => 'required',
            'ator' => 'required',
            'estudio' => 'required'
         ]);

         if($validador->fails())
         {
            return 'Dados incompletos' .validador->errors(true). 500;
         }

         $RegistradorFilmes = Filme::create($buxarFilmes);

         if($RegistradorFilmes)
         {
            return 'Dados cadastrados com sucesso';
         }else
         {
            return 'Dados não cadastrados com sucesso';
         }

    }

    /**
     * Display the specified resource.
     */
    public function buscarId(string $id)
    {
        //Buscar por id

        $buxarFilmes = Filme::find($id);

        if($buxarFilmes){
            return 'Filmes encontradas: - '.$buxarFilmes.response()->json([],
            Response::HTTP_NO_CONTENT);

        }else{
            return 'Filmes não encontrada'.response()->json([],
            Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function atualizar(Request $request, string $id)
    {
        //Atualizar Dados
        $buxarFilmes = $request->all();

        $valida = Validator::make($buxarFilmes,[
            'nome' => 'required',
            'genero' => 'required',
            'ator' => 'required',
            'estudio' => 'required'
        ]);

        if($valida->fails()){
            return "Erro validação!".$valida->$erros().true. 500;

        }
        $dadosFilmes= Filme::find($id);
        $dadosFilmes->nome = $buxarFilmes['nome'];
        $dadosFilmes->genero = $buxarFilmes['genero'];
        $dadosFilmes->ator = $buxarFilmes['ator'];
        $dadosFilmes->estudio = $buxarFilmes['estudio'];


        $enviarFilmes = $dadosFilmes->save();

        if($enviarFilmes){
            return 'O Filme foi alterada com sucesso.'.response()->json([],
            Response::HTTP_NO_CONTENT);

        }else{
            return 'O filme não foi alterada.'.response()->json([],
            Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletar(string $id)
    {
        $dadosFilmes = Filme::find($id);
        $dadosFilmes->delete();

        return 'Filme deletado';
    }
}
