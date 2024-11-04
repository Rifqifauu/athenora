<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';
    protected $primaryKey = 'tiket_id';

    protected $fillable = [
        'kategori',
        'harga'
    ];

    // Relasi dengan model DetailTiket
    public function detailTiket()
    {
        return $this->hasMany(TiketDetail::class, 'tiket_id');
    }
}
