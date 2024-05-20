<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{

protected $table = 't_sales';

    use HasFactory;

    protected $fillable = [ 'kode', 'tgl', 'id_cust','subtotal','diskon','ongkir','total_bayar'];

    public function customer()
    {
        return $this->belongsTo(MCustomer::class, 'id_cust');
    }

    public function salesDetails()
    {
        return $this->hasMany(TSalesDet::class, 'id_sales');
    }


}
