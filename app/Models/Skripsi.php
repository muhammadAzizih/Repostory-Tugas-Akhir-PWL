<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    protected $table = 'skripsi';

    protected $fillable = [
        'user_id', 'jurusan_id', 'title', 
        'sktl_file_path', 'sktl_status', 'sktl_rejection_category', 'sktl_rejection_notes',
        'cover_file_path', 'abstrak_file_path', 'skripsi_file_path', 'daftar_pustaka_file_path',
        'jurnal_file_path', 'turnitin_file_path',
        'file_status', 'file_rejection_category', 'file_rejection_notes',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function getSebutanAttribute()
    {
        if ($this->jurusan && $this->jurusan->jenjang === 'S2') {
            return 'Tesis';
        }
        if ($this->jurusan && $this->jurusan->jenjang === 'S3') {
            return 'Disertasi';
        }
        return 'Skripsi';
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function canUploadFiles()
    {
        return $this->sktl_status === 'verified';
    }}
