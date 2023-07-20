<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cartao extends Model
{
    use HasFactory;
    protected $table = 'cartao';

    protected $fillable = array(
        'cartao_cod',
        'cartao_dtAtivacao'
    );
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function pessoa(){ 
        return $this->belongsToMany(Pessoa::class,'cartao_pessoa');
    }
}
