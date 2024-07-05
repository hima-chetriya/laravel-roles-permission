<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;
    protected  $fillable = ['category_id','sub_category_name','description'];

    public function categories()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }
  
}
