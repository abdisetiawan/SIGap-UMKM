<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = 'kategori';
    protected $fillable = ['nama_ktgr'];

    public function umkm()
    {
        return $this->hasMany(UMKM::class);
    }
    
}
