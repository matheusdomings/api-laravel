<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';

    protected $primaryKey = 'id';

    protected $fillable = ['med_codigo', 'med_nome', 'med_crm', 'espec_id'];

    protected $hidden = ['created_at', 'updated_at', 'espec_id'];

    public function especialidade()
    {
        return $this->hasOne(Especialidade::class, 'id', 'espec_id');
    }
}
