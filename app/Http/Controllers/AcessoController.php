<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acesso;
use App\Models\Cartao;

class AcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Acesso::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$result = Cartao::select("id")->where('cartao_cod', '=',$request->cartao_cod)->get(['id']);

       // if($result !=""){
            return Acesso::create([
                'local_id' => $request->local_id,
                'cartao_id' => $request->cartao_id               ]
            );
       // }else{
       //     return "Cartao não encontrado";
      //  }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Acesso::findOrFail($id);
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
