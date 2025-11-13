<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kuesioner extends Model
{
    use HasFactory;

    protected $table = 'kuesioner';
    protected $primaryKey = 'id_kuesioner';
    public $timestamps = true;

    protected $fillable = [
        'id_admin',
        'id_kategori',
        'nama',
        'deskripsi',
        'sampul',          
        'tanggal_mulai',    
        'tanggal_selesai', 
        'created_by',       
    ];
    protected $casts = [
        'tanggal_mulai'    => 'date',
        'tanggal_selesai'  => 'date',
    ];

    // Relasi (opsional, biar rapi)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function getStatusAttribute(): string
    {
        $today = Carbon::today();

        if (is_null($this->tanggal_mulai) && is_null($this->tanggal_selesai)) {
            return 'aktif';
        }

        if (!is_null($this->tanggal_mulai) && is_null($this->tanggal_selesai)) {
            return $this->tanggal_mulai->lte($today) ? 'aktif' : 'nonaktif';
        }

        if (is_null($this->tanggal_mulai) && !is_null($this->tanggal_selesai)) {
            return $this->tanggal_selesai->gte($today) ? 'aktif' : 'nonaktif';
        }

        return ($this->tanggal_mulai->lte($today) && $this->tanggal_selesai->gte($today))
            ? 'aktif'
            : 'nonaktif';
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'aktif';
    }
    
    public function identitas()
    {
        return $this->hasOne(KonfigurasiIdentitas::class, 'id_kuesioner', 'id_kuesioner');
    }
    
    public function pertanyaan()
    {
        return $this->hasMany(\App\Models\Pertanyaan::class, 'id_kuesioner', 'id_kuesioner');
    }
    
    public function respondens()
    {
        return $this->hasMany(\App\Models\Responden::class, 'id_kuesioner', 'id_kuesioner');
    }
}