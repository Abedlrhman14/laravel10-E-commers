<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function products()
    {
        return $this->hasmanny(product::class,'category_id');
    }
    use HasFactory;
}