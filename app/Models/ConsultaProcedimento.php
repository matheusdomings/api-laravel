<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaProcedimento extends Model
{
    use HasFactory;
    protected $table = 'consulta_procedimento';
    protected $fillable = ['cons_id', 'proc_id'];
}
