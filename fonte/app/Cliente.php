<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'cpf';
    public $timestamps = false;
    protected $fillable = [
        'nome','descricao'
    ];
}