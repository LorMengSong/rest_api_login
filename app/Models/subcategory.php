<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class subcategory extends Model
{
    use HasFactory;
    protected $table = "subcategories";
    protected $guarded = ['id'];
    public function getSubcategory(){
        return $this->hasMany(product::class,'category_id');
    }
}
