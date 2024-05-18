<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    use HasFactory;
    protected $table = 'vinculo';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'paciente_id', 'plano_saude_id', 'nr_contrato'];
    protected $hidden = ['paciente_id', 'plano_saude_id', 'created_at', 'updated_at'];

    public function planoSaude()
    {
        return $this->hasOne(PlanoSaude::class, 'id', 'plano_saude_id');
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'id', 'paciente_id');
    }
}
