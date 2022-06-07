<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    use HasFactory;

    public function options()
    {
        return $this->hasMany(VariantOptions::class,'variants_id','id');
    }
}
