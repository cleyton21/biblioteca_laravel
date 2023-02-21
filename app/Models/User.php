<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'level',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function livros()
    {
        return $this->belongsToMany('App\Models\Livro','emprestimos', 'id_user', 'id_livro')
        ->withPivot(['dt_ini', 'dt_end', 'entregue', 'qnt']) //colunas da tabela pivot que irão aparecer, além dos ids
        ->wherePivot('entregue',0) //clausula where na tabela pivot
        ->orderByPivot('dt_end', 'desc')
        ;
    }

    public function userDelete()
    {
        return $this->belongsToMany('App\Models\Livro','emprestimos', 'id_user', 'id_livro')
        ->withPivot(['id_user', 'entregue']) //colunas da tabela pivot que irão aparecer, além dos ids
        ->wherePivot('entregue',0) //clausula where na tabela pivot
        ;
    }

    public function setSlug()
    {
        if(!empty($this->name)){
            $this->attributes['slug'] = Str::of($this->name)->slug('-');
            $this->save();
            return;
        }
    }
}
