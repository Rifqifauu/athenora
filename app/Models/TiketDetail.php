<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketDetail extends Model
{
    use HasFactory;

    protected $table = 'detail_tiket';

    protected $fillable = [
        'kode',
        'tiket_id',
        'user_id',
        'status',
    ];

    public $timestamps = true; 

    // Relasi dengan model Tiket
    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'tiket_id');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
