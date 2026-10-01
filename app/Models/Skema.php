<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pesertas()
    {
        return $this->hasMany(Peserta::class);
    }
}
