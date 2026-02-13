<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'price',
        'sale_price',
        'description',
        'short_description',
        'quantity',
        'thumbnail',
        'status'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }


    public function attributeValues()
    {
        return $this->belongsToMany(
            ProductAttributeValue::class,
            'product_attribute_assigns',
            'product_id',
            'attribute_value_id'
        )->with('attribute');
    }






    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function wishlistedBy()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'wishlists',
            'product_id',
            'user_id'
        );
    }
}
