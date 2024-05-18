<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanoSaude extends Model
{
    use HasFactory;
    protected $table = 'plano_saude';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'plano_codigo', 'plano_descricao', 'plano_telefone'];
}
