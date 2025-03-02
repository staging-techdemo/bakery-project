<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // protected $table = 'faq';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
    
    
       public function get_products()
    {
        return $this->belongsTo("App\Models\Products", 'product_id');
    }
    
}
