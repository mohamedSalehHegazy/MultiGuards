<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name_en','name_ar','parent_id','active'
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeOnlyParents(Builder $query):Builder
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOnlySubCategories(Builder $query):Builder
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeOnlyActive(Builder $query):Builder
    {
        return $query->whereActive(true);
    }
}
