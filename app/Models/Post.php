<?php

namespace Classie\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    public function images(): HasMany
    {
        return $this->hasMany(PostImage::class);
    }
}
