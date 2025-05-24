<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutProduct extends Model
{
    /** @use HasFactory<\Database\Factories\StockOutProductFactory> */
    use HasFactory;
    protected $guarded = [];
}
