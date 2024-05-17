<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'paciente';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'pac_codigo', 'pac_nome', 'pac_telefone', 'pac_dt_nascimento'];
}
