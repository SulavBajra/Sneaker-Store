<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'colorway_id',
        'sku',
        'size',
        'width',
        'price',
        'compare_at_price',
        'stock_qty',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'decimal:1',
            'price' => 'decimal:2',
            'compare_at_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

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

    // ── Helpers ────────────────────────────────────────
    public function isOnSale(): bool
    {
        return ! is_null($this->compare_at_price)
            && $this->compare_at_price > $this->price;
    }

    public function discountPercentage(): ?int
    {
        if (! $this->isOnSale()) {
            return null;
        }

        return (int) round(
            (($this->compare_at_price - $this->price) / $this->compare_at_price) * 100
        );
    }

    public function inStock(): bool
    {
        return $this->stock_qty > 0;
    }
}
