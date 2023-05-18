<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $table = 'main_categories';

    protected $fillable = ['name', 'details', 'photo', 'active', 'created_at', 'updated_at'];

    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'details', 'photo', 'active');
    }
    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value !== null) ? asset('assets/svg/main_categories/' . $value) : ""
        );
    }

    public function subCategories()
    {
        return $this->hasMany('App\Models\Store\SubCategory', 'main_category_id', 'id');
    }


    public function products()
    {
        return $this->hasMany('App\Models\Store\Product', 'main_category_id', 'id');
    }

    public function getActive(){
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }
}
