<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    // ── Relationships ──────────────────────────────────
    /** @return BelongsTo<Category, Category> */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /** @return HasMany<Category> */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /** @return HasMany<Product> */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
