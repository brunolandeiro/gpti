<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Efs extends Model
{
    protected $table = 'efs';
    protected $primaryKey = 'cod_efs';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'nome','descricao'
    ];

    public function etapas()
    {
        return $this->belongsToMany('App\Etapa', 'efs_etapa', 'cod_efs', 'cod_etapa');
    }
}