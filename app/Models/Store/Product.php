<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name', 'details', 'price', 'amount', 'photo', 'active', 'discounts',
        'main_category_id', 'sub_category_id', 'created_at', 'updated_at'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'details', 'price', 'discounts', 'amount', 'photo', 'active', 'main_category_id', 'sub_category_id');
    }

    public function scopeDiscounts($query)
    {
        return $query->where('discounts', '>', 0);
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value !== null) ? asset('assets/images/products/'. $value) : ""
        );
    }

    public function mainCategory()
    {
        return $this->belongsTo('App\Models\Store\MainCategory', 'main_category_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\Store\SubCategory', 'sub_category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Store\Product', 'sub_category_id', 'id');
    }
}
