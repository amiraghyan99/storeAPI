<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\HasDiffForHumans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static search(array $only)
 */
class Store extends Model
{
    use HasFactory, HasFilters, HasDiffForHumans;

    /**
     * @var array|string[]
     */
    protected array $searchable_fields = ['name'];

    /**
     * @var string
     */
    protected string $searchable_key = 'search';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
