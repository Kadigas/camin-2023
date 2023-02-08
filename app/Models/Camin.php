<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camin extends Model
{
    use HasFactory;

    protected $table = "camins";
    protected $fillable = ["nama", "nrp", "jurusan", "angkatan_id"];

    public function angkatan(){
        return $this->belongsTo(Angkatan::class);
    }
}
