<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Processo extends Model
{
    protected $table = 'processo';
    protected $primaryKey = 'cod_proc';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'nome','descricao'
    ];

    public function etapas()
    {
        return $this->hasMany('App\Etapa', 'cod_proc', 'cod_proc');
    }
}