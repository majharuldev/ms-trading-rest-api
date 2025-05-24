<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    /** @use HasFactory<\Database\Factories\StockProductFactory> */
    use HasFactory;

    protected $guarded = [];
}
