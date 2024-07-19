<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table='invoice';
    protected $fillable=['invoice_name','order_id'];

    public function orders(){
        return $this->belongsToMany( Order::class,'invoice_order');
    }
}
