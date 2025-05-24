<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    /** @use HasFactory<\Database\Factories\PartsFactory> */
    use HasFactory;
    protected $guarded = [];
}
