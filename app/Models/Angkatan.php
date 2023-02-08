<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;

    protected $table = "angkatans";
    protected $fillable = ["nama", "slug"];

    public function camin(){
        return $this->hasMany(Camin::class);
    }
}
