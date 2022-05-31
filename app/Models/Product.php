<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'count'];

    /**
     * Product Store
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Product Categories
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Product Colors
     * @return BelongsToMany
     */
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    /**
     * Product Sizes
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    /**
     * Product Materials
     * @return BelongsToMany
     */
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }

    /**
     * Product Images (Polymorphic Table 'Images')
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'imageable');
    }
}
