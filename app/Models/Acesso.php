<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    use HasFactory;
    protected $table='acesso';
    protected $fillable=['local_id','cartao_id','acesso_DH'];

}
