<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalContent extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari nama model (default adalah plural dari nama model)
    protected $table = 'educational_contents';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'title',       // Judul konten
        'description', // Deskripsi konten
        'file_path',   // Lokasi file yang diunggah
    ];

    // Tentukan tipe kolom
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Jika Anda menggunakan timestamps otomatis, Laravel akan mengelola created_at dan updated_at
    public $timestamps = true;

    // Relasi jika diperlukan (misalnya, jika konten terkait dengan model lain, tambahkan relasi di sini)
    // Contoh: Jika ada relasi ke pengguna atau kategori
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
