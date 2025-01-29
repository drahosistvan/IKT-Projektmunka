<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use InteractsWithMedia, HasFactory;

    protected $casts = [
        'featured' => 'boolean',
        'is_visible' => 'boolean',
        'published_at' => 'date',
        'price' => 'integer',
        'old_price' => 'integer',
        'cost' => 'integer',
    ];

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'barcode',
        'category_id',
        'description',
        'qty',
        'featured',
        'is_visible',
        'old_price',
        'price',
        'cost',
        'published_at',
        'seo_title',
        'seo_description',
        'weight',
        'height',
        'width',
        'depth',
    ];

    protected $appends = [
        'main_image', 'formatted_price',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function formattedPrice(): Attribute {
        return Attribute::make(
            get: fn ($value, $attributes) => number_format($this->price, 0, ',', ' ') . ' Ft'
        );
    }

    public function mainImage(): Attribute {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->getFirstMediaUrl('product-images', 'thumb')
        );
    }


}
