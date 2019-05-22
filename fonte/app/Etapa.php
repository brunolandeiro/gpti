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

    public function area()
    {
        return $this->belongsTo('App\Area', 'cod_area', 'cod_area');
    }

    public function processo()
    {
        return $this->belongsTo('App\Processo', 'cod_proc', 'cod_proc');
    }

    public function efss()
    {
        return $this->belongsToMany('App\Efs', 'efs_etapa', 'cod_etapa', 'cod_efs');
    }
}