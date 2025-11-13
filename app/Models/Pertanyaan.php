<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    public $timestamps = true;

    protected $fillable = [
        'id_kuesioner',
        'teks',
        'urutan',
        'status_aktif',
    ];

    protected $casts = [
        'urutan' => 'integer',
        'status_aktif' => 'boolean',
    ];

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner', 'id_kuesioner');
    }
}