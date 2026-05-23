<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $fillable = ['name'];

    public function jurusans()
    {
        return $this->hasMany(Jurusan::class);
    }}
