<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user', 'category'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) => $query->where('title', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) => $query->whereHas(
                'category',
                fn($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['user'] ?? false,
            fn($query, $user) => $query->whereHas(
                'user',
                fn($query) =>
                $query->where('username', $user)
            )
        );
    }
}
