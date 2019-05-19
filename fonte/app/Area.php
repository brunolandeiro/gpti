<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'cod_area';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'nome','descricao'
    ];

    public function etapas()
    {
        return $this->hasMany('App\Etapa', 'cod_area', 'cod_area');
    }
}