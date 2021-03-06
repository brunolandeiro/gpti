<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Projeto extends Model
{
    protected $table = 'projeto';
    protected $primaryKey = 'cod_projeto';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'nome','descricao','cpf'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cpf', 'cpf');
    }

    public function fases()
    {
        return $this->hasMany('App\Fase', 'cod_projeto', 'cod_projeto');
    }
}