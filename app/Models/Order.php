<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table= 'orders';
    protected $fillable = ['item_id', 'total_price','item_qty','item_price','item_name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
