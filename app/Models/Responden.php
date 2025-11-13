<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Responden extends Model
{
    use HasFactory;

    protected $table = 'responden';
    protected $primaryKey = 'id_responden';
    public $timestamps = true;

    protected $fillable = [
        'id_kuesioner',
        'id_pengisi',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner', 'id_kuesioner');
    }
    
    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_responden', 'id_responden');
    }
}