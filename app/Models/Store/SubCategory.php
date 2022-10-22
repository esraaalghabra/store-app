<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = ['name', 'details', 'main_category_id', 'photo', 'active', 'created_at', 'updated_at'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSelection($query)
    {
        return $query->select('id','name', 'details', 'main_category_id', 'photo', 'active');
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value !== null) ? asset('assets/svg/sub_categories/' . $value) : ""
        );
    }


    public function mainCategory()
    {
        return $this->belongsTo('App\Models\Store\MainCategory', 'main_category_id', 'id');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Store\Product', 'sub_category_id', 'id');
    }
}
