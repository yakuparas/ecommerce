<?php

namespace App\Models;

use App\Http\Controllers\Backend\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasOne(ProductController::class);
    }
}
