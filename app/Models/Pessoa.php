<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cartao;

class Pessoa extends Model
{
    use HasFactory;
    protected $table = "pessoa";
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nomeCompleto','sexo','dtNasc','CPF','email','celular','id_setor'];
    
    public function setor(){
        return $this->belongsTo(Setor::class);
    }
    public function cartao(){
        return $this->belongsToMany(Cartao::class,'cartao_pessoa');
    }
}
