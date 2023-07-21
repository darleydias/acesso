<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartao;
use App\Http\Requests\StoreUpdateCardRequest;
class CartaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cartao::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Cartao::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cartao::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cartao = Cartao::findOrFail($id);
        return $cartao->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Cartao::destroy($id);
    }
}
