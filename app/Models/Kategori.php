<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = true;

    protected $fillable = [
        'nama',
    ];

    public function kuesioner()
    {
        return $this->hasMany(Kuesioner::class, 'id_kategori', 'id_kategori');
    }
}
