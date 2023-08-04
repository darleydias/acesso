<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Local extends Model
{
    use HasFactory;
    protected $table = 'local';
    protected $fillable = ['local_nome'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function acessos(){
        return $this->hasMany(Acesso::class);
    }
}
