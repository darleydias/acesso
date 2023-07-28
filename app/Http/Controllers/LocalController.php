<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Acesso;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Local::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'local_nome' => 'required|min:3|max:255',
            'local_mac' => 'required'
        ]);
        return Local::create($request->all());
    }
     /**
     * Store a newly created resource in storage.
     */
    public function listaAcessos(string $id)
    {
        $acesso=Acesso::leftJoin('cartao', 'acesso.cartao_id', '=', 'cartao.id')
        ->leftJoin('cartao_pessoa', 'cartao_pessoa.cartao_id', '=', 'acesso.cartao_id')
        ->leftJoin('pessoa', 'pessoa.id', '=', 'cartao_pessoa.pessoa_id')
        ->leftJoin('local', 'local.id', '=', 'acesso.local_id')
        ->leftJoin('setor', 'setor.id', '=', 'pessoa.id_setor')
        ->whereNotNull('cartao.cartao_cod')
        ->where('local.id',$id)
        ->select('acesso.acesso_DH','pessoa.nomeCompleto','local.local_nome')->paginate(10);
        if(!empty($acesso)){
            return $acesso;
        }else{
            return ['msg'=>'acessos não encontrados para a pessoa'];
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Local::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $local =  Local::findOrFail($id);
        $local->update($request->all());
        return $local;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Local::destroy($id);
    }
}
