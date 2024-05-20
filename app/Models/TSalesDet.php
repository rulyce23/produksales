<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TSalesDet extends Model
{
    protected $table = 't_sales_detail';

    public function barang()
    {
        return $this->belongsTo(MBarang::class, 'id_barang');
    }

    public function sales()
    {
        return $this->belongsTo(Transaksi::class, 'id_sales');
    }
}
?>