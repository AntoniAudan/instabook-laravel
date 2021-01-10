<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected static function booted() {
        static::creating(function ($comment) {
            return !is_null($comment->photo->group->users->find($comment->user_id));
        });
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function photo()
     {
         return $this->belongsTo(Photo::class);
     }

    /**
     * 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function user()
     {
         return $this->belongsTo(User::class);
     }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replyTo()
     {
        return $this->belongsTo(Comment::class,'comment_id','id');
     }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
     {
         return $this->hasMany(Comment::class);
     }
}
