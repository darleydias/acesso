<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\CursorPaginator;
use Illuminate\Http\Request;
use App\Models\Acesso;
use App\Models\Cartao;
use App\Models\Local;

class AcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Acesso::leftJoin('cartao', 'acesso.cartao_id', '=', 'cartao.id')
        ->leftJoin('cartao_pessoa', 'cartao_pessoa.cartao_id', '=', 'acesso.cartao_id')
        ->leftJoin('pessoa', 'pessoa.id', '=', 'cartao_pessoa.pessoa_id')
        ->leftJoin('local', 'local.id', '=', 'acesso.local_id')
        ->leftJoin('setor', 'setor.id', '=', 'pessoa.id_setor')
        ->whereNotNull('cartao.cartao_cod')
        ->whereRaw('acesso.acesso_DH >= curdate()') // Só os de hoje
        ->select('pessoa.id as pessoa_id','acesso.acesso_DH','pessoa.nomeCompleto','local.local_nome')->paginate(10);
    }
    public function indexInterval(Request $request)
    {
       if($request->inicial==""){ // Senão foi informada a data inicial retorna
        return ['msg'=>'informe a data inicial'];
       } 
       if($request->final==""){ // foi informada a inicial mas a final não. Então considera até hoje. 
            return Acesso::leftJoin('cartao', 'acesso.cartao_id', '=', 'cartao.id')
            ->leftJoin('cartao_pessoa', 'cartao_pessoa.cartao_id', '=', 'acesso.cartao_id')
            ->leftJoin('pessoa', 'pessoa.id', '=', 'cartao_pessoa.pessoa_id')
            ->leftJoin('local', 'local.id', '=', 'acesso.local_id')
            ->leftJoin('setor', 'setor.id', '=', 'pessoa.id_setor')
            ->whereNotNull('cartao.cartao_cod')
            ->whereRaw('acesso.acesso_DH >?',[$request->inicial])
            ->select('pessoa.id as pessoa_id','acesso.acesso_DH','pessoa.nomeCompleto','local.local_nome')->paginate(10); 
       }else{
            return Acesso::leftJoin('cartao', 'acesso.cartao_id', '=', 'cartao.id')
            ->leftJoin('cartao_pessoa', 'cartao_pessoa.cartao_id', '=', 'acesso.cartao_id')
            ->leftJoin('pessoa', 'pessoa.id', '=', 'cartao_pessoa.pessoa_id')
            ->leftJoin('local', 'local.id', '=', 'acesso.local_id')
            ->leftJoin('setor', 'setor.id', '=', 'pessoa.id_setor')
            ->whereNotNull('cartao.cartao_cod')
            ->whereBetween('acesso.acesso_DH', [$request->inicial, $request->final])
            ->select('pessoa.id as pessoa_id','acesso.acesso_DH','pessoa.nomeCompleto','local.local_nome')->paginate(10); 
            
       }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $result = Cartao::findOrFail($request->cartao_id);
        }catch(\Exception $e){
            return ['msg'=>'Cartao não encontrado'];
        }
        try{
            $result = Local::findOrFail($request->local_id);
        }catch(\Exception $e){
            return ['msg'=>'Local não encontrado'];
        }
        try{
            return Acesso::create([
                    'local_id' => $request->local_id,
                    'cartao_id' => $request->cartao_id               ]
                );
        }catch(\Exception $e){
            return ['msg'=>'Acesso não registrado'];
        }  
    }

    /**
     * Display the specified resource.
     */
    public function showByPerson(string $id)
    {
        $acesso=Acesso::leftJoin('cartao', 'acesso.cartao_id', '=', 'cartao.id')
        ->leftJoin('cartao_pessoa', 'cartao_pessoa.cartao_id', '=', 'acesso.cartao_id')
        ->leftJoin('pessoa', 'pessoa.id', '=', 'cartao_pessoa.pessoa_id')
        ->leftJoin('local', 'local.id', '=', 'acesso.local_id')
        ->leftJoin('setor', 'setor.id', '=', 'pessoa.id_setor')
        ->whereNotNull('cartao.cartao_cod')
        ->where('pessoa.id',$id)
        ->select('acesso.acesso_DH','pessoa.nomeCompleto','local.local_nome')->paginate(10);
        if(!empty($acesso)){
            return $acesso;
        }else{
            return ['msg'=>'acessos não encontrados para a pessoa'];
        }
    }
    public function showByCard(string $id)
    {
         
        $acesso=Acesso::leftJoin('cartao', 'acesso.cartao_id', '=', 'cartao.id')
        ->leftJoin('cartao_pessoa', 'cartao_pessoa.cartao_id', '=', 'acesso.cartao_id')
        ->leftJoin('pessoa', 'pessoa.id', '=', 'cartao_pessoa.pessoa_id')
        ->leftJoin('local', 'local.id', '=', 'acesso.local_id')
        ->leftJoin('setor', 'setor.id', '=', 'pessoa.id_setor')
        ->whereNotNull('cartao.cartao_cod')
        ->where('cartao.id',$id)
        ->select('acesso.acesso_DH','pessoa.nomeCompleto','local.local_nome')->paginate(10);
        if(!empty($acesso)){
            return $acesso;
        }else{
            return ['msg'=>'acessos não encontrados para o cartao informado'];
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $acesso = Acesso::findOrFail($id);
       return $acesso->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Acesso::destroy($id);
    }

}
