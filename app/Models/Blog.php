<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function polyComments(): MorphMany
    {
        return $this->MorphMany(PolyComment::class, 'commentable');
    }

    public function polyTags(): MorphToMany
    {
        return $this->MorphToMany(PolyTag::class, 'taggable');
    }
}
