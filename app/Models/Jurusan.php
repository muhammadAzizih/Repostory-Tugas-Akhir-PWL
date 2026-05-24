<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    
    protected $fillable = ['name', 'fakultas_id', 'jenjang'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function skripsis()
    {
        return $this->hasMany(Skripsi::class);
    }}
