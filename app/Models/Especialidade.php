<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;

    protected $table = 'especialidade';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'espec_codigo', 'espec_nome'];

    protected $hidden = ['created_at', 'updated_at'];


}
