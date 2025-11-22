<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $primaryKey = 'id_section';
    public $timestamps = true;

    protected $fillable = [
        'id_kuesioner',
        'judul',
        'urutan',
    ];

    // Relationship with Kuesioner
    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner', 'id_kuesioner');
    }

    // Relationship with Pertanyaan
    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_section', 'id_section');
    }
}
