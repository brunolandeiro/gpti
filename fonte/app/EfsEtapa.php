<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class EfsEtapa extends Model
{
    protected $table = 'efs_etapa';
    protected $primaryKey = ['cod_efs', 'cod_etapa'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'tipo'
    ];

    public function etapas(){
        return $this->hasMany('App\Etapa', 'cod_etapa', 'cod_etapa');
    }

    public function efss(){
        return $this->hasMany('App\Efs', 'cod_efs', 'cod_efs');
    }

}