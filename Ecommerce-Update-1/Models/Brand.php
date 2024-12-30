<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name',
    ];

    // Relationship to Product
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}