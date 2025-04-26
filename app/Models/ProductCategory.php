<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductCategory extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use InteractsWithMedia, HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_visible',
        'description',
    ];
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    /**
     * Scope a query to only include visible categories.
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_visible', true);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
