<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'product';
    protected $fillable = [
        "title",
        "price",
        "description",
        "author",
    ];
    public function Author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
