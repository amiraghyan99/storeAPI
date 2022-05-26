<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];
    protected $table = 'stores';

    public function user(){
        return $this->belongsTo(User::class);
    }

//    public function products(){
//        return $this->hasMany(...);
//    }

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->diffForHumans();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });
    }
}
