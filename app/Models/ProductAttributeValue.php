<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    protected $fillable = ['attribute_id', 'value', 'status'];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(ProductAttributeValue::class, 'product_attribute_assigns', 'product_id', 'attribute_value_id')->withPivot('attribute_id');
    }
}
