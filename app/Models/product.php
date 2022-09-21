<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $guarded = ['id'];
    protected $fillable = [
        "id",
        "category_id",
        "qty",
        "price"
    ];
    public function getCategory(){
        return $this->belongsTo(subcategory::class,'sub_id');
    }
}
