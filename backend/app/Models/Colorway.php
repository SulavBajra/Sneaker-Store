<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Colorway extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'product_id',
        'name',
        'colorway_code',
        'release_date',
        'is_limited_edition',
    ];

    protected function casts(): array
    {
        return [
            'release_date' => 'date',
            'is_limited_edition' => 'boolean',
        ];
    }

    // ── Media ──────────────────────────────────────────
    public function registerMediaCollections(?Media $media = null): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('primary')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('card')->width(600)->height(600);
        $this->addMediaConversion('zoom')->width(1200)->height(1200);
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300);
    }

    // ── Relationships ──────────────────────────────────
    /**
     * @return BelongsTo<Product>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo<Colorway>
     */
    public function colorway(): BelongsTo
    {
        return $this->belongsTo(Colorway::class);
    }

    /**
     * @return HasMany<ProductVariant>
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    // ── Helpers ────────────────────────────────────────
    public function isNewRelease(): bool
    {
        return $this->release_date?->isAfter(now()->subDays(30)) ?? false;
    }
}
