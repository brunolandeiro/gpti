<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Fase extends Model
{
    protected $table = 'fase';
    protected $primaryKey = 'cod_fase';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'dt_ini','dt_fim','descricao','cod_projeto','cod_proc'
    ];
}