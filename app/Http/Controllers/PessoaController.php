<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\CartaoPessoa;
use App\Models\Setor;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(is_null(Pessoa::first())){
            return ['msg'=>'Nenhuma pessoa cadastrada'];
        }else{
            return Pessoa::paginate(10);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$request->validate(['nomeCompleto'=>'required']);
        try{
            try{
                $setor = Setor::findOrFail($request->id_setor);
            }catch (\Exception $e) {
                return ['msg'=>"Setor não exite"];       
            }  
            
            return Pessoa::create($request->all()); 
        }catch (\Exception $e) {
            return ['msg'=>"Dados não informados"];       
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            return Pessoa::findOrFail($id);
        }catch (\Exception $e) {
            return ['msg'=>"pessoa não encontrada"];       
        }   
    }
    public function showByidCartao($id)
    {
       return CartaoPessoa::leftJoin('pessoa', 'pessoa.id', '=', 'cartao_pessoa.pessoa_id')
        ->leftJoin('cartao', 'cartao.id', '=', 'cartao_pessoa.cartao_id')
        ->leftJoin('setor', 'setor.id', '=', 'pessoa.id_setor')
        ->whereNotNull('cartao.cartao_cod')
        ->where('cartao.id',$id) // Só os de hoje
        ->select('cartao.id as id_cartao', 'pessoa.id as id_pessoa','pessoa.nomeCompleto','setor.nome as setor','pessoa.celular','pessoa.path_image')->get()->all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $pessoa = Pessoa::findOrFail($id);
            $pessoa->update($request->all());
            return ['msg'=>'pessoa atualizado'];
        }catch (\Exception $e) {
            return ['msg'=>"pessoa não encontrada"];       
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pessoa = Pessoa::destroy($id);
        if($pessoa==0){
            return ['msg'=>'nenhum item removido'];
        }else{
            return ['msg'=>'item removido'];
        }
    }
    /**
     * Display the specified resource.
     */
    public function clientes(string $id)
    {
        try{
            $pessoa = Pessoa::findOrFail($id);
            return $pessoa->clientes;
        }catch (\Exception $e) {
            return ['msg'=>"pessoa não encontrado"];       
        }   
    }
    public function adicionaFoto(Request $request,string $id)
    {   
        try {
              $pessoa= Pessoa::where('id', $id)
              ->update(['path_image' => $request->path_image]);
              return ['msg'=>'Foto de '.$pessoa->nomeCompleto.' Atualizada'];

        }catch (\Exception $e) {
                return 0;       
        }
    }

}
