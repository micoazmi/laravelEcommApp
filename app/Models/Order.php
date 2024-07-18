<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table= 'orders';
    protected $fillable = ['item_id', 'total_price','item_qty','item_price','item_name'];

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }
}
