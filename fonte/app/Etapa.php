<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Etapa extends Model
{
    protected $table = 'etapa';
    protected $primaryKey = 'cod_etapa';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'cod_proc','cod_area','nome','descricao'
    ];
}