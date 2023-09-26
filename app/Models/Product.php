<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'three_pack_price', 'five_pack_price'];
    protected $appends = ['isDeletable'];

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function isDeletable()
    {
        if ($this->orders()->count() > 0) {
            return false;
        }

        return true;
    }

    public function getIsDeletableAttribute()
    {
        return $this->isDeletable();
    }

    /**
     * Calculate product prices based on pack prices
     *
     * @param  mixed $this
     * @param  mixed $quantity
     * @return int
     */
    public function calculate(int $quantity): int {

        $totalPrice = 0;

        if($quantity / 5  >= 1 && $this->five_pack_price > 0){
            $totalPrice += intdiv($quantity, 5) *  $this->five_pack_price;
            $quantity = $quantity % 5;
        }
        
        if($quantity / 3  >= 1 && $this->three_pack_price > 0){
            $totalPrice += intdiv($quantity, 3) *  $this->three_pack_price;
            $quantity = $quantity % 3;
        }
        
        if($quantity >= 1){
            $totalPrice += $quantity * $this->price;
        }

        return $totalPrice;
    }
}
