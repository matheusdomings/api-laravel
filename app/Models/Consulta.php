<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $table = 'consulta';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'cons_codigo', 'med_id', 'pac_id', 'particular', 'data', 'hora', 'vinculo_id'];
    protected $hidden = ['med_id','pac_id', 'vinculo_id', 'created_at', 'updated_at'];

    public function medico(){
        return $this->hasOne(Medico::class, 'id', 'med_id')->with('especialidade');
    }

    public function vinculo(){
        return $this->hasOne(Vinculo::class, 'id', 'vinculo_id')->with('planoSaude');
    }

    public function paciente(){
        return $this->hasOne(Paciente::class, 'id', 'pac_id');
    }

    public function procedimento()
    {
        return $this->belongsToMany(Procedimento::class, 'consulta_procedimento', 'cons_id', 'proc_id');
    }

}
