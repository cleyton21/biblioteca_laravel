<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Livro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'isbn',
        'titulo',
        'subtitulo',
        'slug',
        'descricao',
        'quantidade',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User','emprestimos', 'id_livro', 'id_user')
        ->withPivot(['id', 'dt_ini', 'dt_end', 'entregue', 'qnt']) //colunas da tabela pivot que irão aparecer, além dos ids
        ->wherePivot('entregue',0) //clausula where na tabela pivot
        ->orderByPivot('dt_end', 'desc');
        ;
    }

    public function setSlug()
    {
        if(!empty($this->titulo)){
            $this->attributes['slug'] = Str::of($this->titulo)->slug('-');
            $this->save();
            return;
        }
    }

}
