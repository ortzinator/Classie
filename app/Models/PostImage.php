<?php

namespace Classie\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostImage extends Model
{
    protected $fillable = ['file'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
