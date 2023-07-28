<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        try{
            $path = Storage::putFile('image', $request->image);
            return response()->json(['path' => $path]);
        } catch(FileException $e) {
            return $e;
        }
    }

    public function getImage($path)
    {
        return Storage::response($path);
     }
}