<?php

namespace App\Models;

use App\Models\Responden;
use App\Models\Pertanyaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';
    public $timestamps = true;

    protected $fillable = [
        'id_respon',
        'id_pertanyaan',
        'jawaban',
    ];

    public function responden()
    {
        return $this->belongsTo(Responden::class, 'id_respon', 'id_respon');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }
}