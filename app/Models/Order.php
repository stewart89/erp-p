<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['final_price'];

    public function products(){
        $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    
    /**
     * isDeletable
     *
     * @return boolean
     */
    public function isDeletable(): bool
    {
        if ($this->finalized_at !== null) {
            return false;
        }

        return true;
    }
}
