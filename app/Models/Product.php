<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'slug', 'category_id', 'description', 'content', 'price', 'version', 'release_date', 'sort_order', 'is_active', 'demo_link', 'features'];

    protected $casts = ['is_active' => 'boolean', 'price' => 'decimal:2', 'features' => 'array', 'release_date' => 'date'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
