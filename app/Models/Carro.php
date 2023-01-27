<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'modelo',
        'placa',
        'valor',
        'cor',
        'ano',
        'status',
        'quantidade_de_parcelas',
        'data_de_venda',
        'user_id'
    ];

    public function formatarMoedaEmReais()
    {
        return 'R$ ' . number_format(($this->valor / 100), 2, ',', '.');
    }

    const STATUS = ['Disponível', 'Vendido'];
}
