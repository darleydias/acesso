<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;

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
        return Local::create($request->all());
    }
     /**
     * Store a newly created resource in storage.
     */
    public function listaAcessos(string $id)
    {
        $locaL = Local::find($id);
        if($local){
            $response = [
                'local'=>$locaL,
                'acesso'=>$local->acessos
            ];
        }
        return $response;
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
