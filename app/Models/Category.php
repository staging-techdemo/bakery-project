<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{    
    protected $table = 'category';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function get_categories()
    {
        return $this->belongsTo("App\Models\Product_categories", 'category_id', 'id');
    }

    // public function subcategories()
    // {
    //     return $this->hasMany(Sub_category::class, 'category_id');
    // }
    public function subcategories()
{
    return $this->hasMany(Sub_category::class, 'category_id')
                ->orderBy('title', 'asc');
}
}