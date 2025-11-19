<?php

namespace App\Models;

use App\Models\Jawaban;
use App\Models\Kuesioner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Responden extends Model
{
    use HasFactory;

    protected $table = 'responden';
    protected $primaryKey = 'id_respon';
    public $timestamps = true;

    protected $fillable = [
        'id_kuesioner',
        'identitas1',
        'identitas2',
        'identitas3',
        'identitas4',
        'identitas5',
        'fingerprint',
        'waktu_submit',
    ];

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner', 'id_kuesioner');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_respon', 'id_respon');
    }
}