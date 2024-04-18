<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected string $table = 'categories';
    protected string $primaryKey = 'id';
    protected string $KeyType = 'int';
    public bool $timestamps = true;
    public bool $incrementing = true;
    protected array $fillable = [
        'name',
        'description',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(post::class);
    }
}
