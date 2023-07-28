<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaoPessoa extends Model
{
    use HasFactory;
    protected $table = 'cartao_pessoa';
    protected $fillable= ['cartao_id','pessoa_id','cartaoPessoa_dtEntrega'];
}
