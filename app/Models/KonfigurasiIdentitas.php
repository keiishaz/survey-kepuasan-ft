<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KonfigurasiIdentitas extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi_identitas';
    protected $primaryKey = 'id_konfigurasi';
    public $timestamps = true;

    protected $fillable = [
        'id_kuesioner',
        'id_admin',
        'atribut1',
        'atribut2',
        'atribut3',
        'atribut4',
        'atribut5',
        'wajib1',
        'wajib2',
        'wajib3',
        'wajib4',
        'wajib5',
    ];

    protected $casts = [
        'wajib1' => 'boolean',
        'wajib2' => 'boolean',
        'wajib3' => 'boolean',
        'wajib4' => 'boolean',
        'wajib5' => 'boolean',
    ];

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner', 'id_kuesioner');
    }
    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}