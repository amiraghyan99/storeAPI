<?php

namespace App\Models;

use App\Traits\HasSearch;
use App\Traits\HasDiffForHumans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static search(array $only)
 */
class Store extends Model
{
    use HasFactory, HasSearch, HasDiffForHumans;

    /**
     * @var array|string[]
     */
    protected array $searchable_fields = ['name', 'description'];

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

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

}
