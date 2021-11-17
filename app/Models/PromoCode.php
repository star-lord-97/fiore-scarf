<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    function calculateDiscount($subTotal)
    {
        if ($this->type == 'fixed') {
            return $subTotal - $this->value;
        } else if ($this->type == 'percent') {
            return $subTotal - ($subTotal * ($this->percent_off / 100));
        }
    }
}
