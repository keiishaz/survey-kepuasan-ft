<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';
    public $timestamps = true;

    protected $fillable = [
        'id_responden',
        'id_pertanyaan',
        'jawaban',
        'created_by',
    ];

    public function responden()
    {
        return $this->belongsTo(Responden::class, 'id_responden', 'id_responden');
    }
    
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }
}