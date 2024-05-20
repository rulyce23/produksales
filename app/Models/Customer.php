<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

protected $table = 'm_customer';

    use HasFactory;

    protected $fillable = [ 'kode', 'nama', 'telepon','jk','nik','alamat','goldar','tgl_lahir' ];

    public function sales()
    {
        return $this->hasMany(Transaksi::class, 'id_cust');
    }
}
