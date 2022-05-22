<?php

namespace App\Models;

use App\Enums\ServiceEnum;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'price',
        'image_url',
        'brand',
        'category_id',
        'original_id',
        'service',
        'bought',
        'description',
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function service(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value === ServiceEnum::JMART->value ? 'Jmart' : ($value === ServiceEnum::MECHTA->value ? 'Mechta' : 'Technodom'),
        );
    }

}
