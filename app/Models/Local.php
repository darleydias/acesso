<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    protected $table = 'local';
    protected $fillable = ['local_nome'];

    public function acessos(){
        return $this->hasMany(Acesso::class);
    }
}
