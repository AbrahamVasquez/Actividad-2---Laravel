<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'cantidad',
        'total',
        'id_usuario',
    ];

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario'); // Will get user ID foreach of the products
    }
}
