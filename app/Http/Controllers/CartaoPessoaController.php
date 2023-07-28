<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartaoPessoa;
use App\Models\Cartao;

class CartaoPessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartaoPessoa::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(CartaoPessoa::create($request->all())){
            return response()->json(['message'=>'Cartão associado a pessoa'],201);
        }else{
            return response()->json(['message'=>'Erro na associação de cartão a pessoa'],500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CartaoPessoa::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $CartaoPessoa = CartaoPessoa::findOrFail($id);
        return $CartaoPessoa->update($request->all());  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CartaoPessoa::destroy($id);
    }
    /**
     * Display the specified card.
     */
    public function testaCartao(Request $request,string $codCartao)
    {   
        try {
                $cartao = Cartao::all()->where('cartao_cod',$codCartao)->first();
                return $cartao->id;   
            
        }catch (\Exception $e) {
                return 0;       
        }
    }

}
