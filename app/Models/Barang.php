<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

protected $table = 'm_barang';

    use HasFactory;

    protected $fillable = [ 'kode', 'nama', 'harga','jenis' ];

    public function salesDetails()
    {
        return $this->hasMany(TSalesDet::class, 'id_barang');
    }
}
