<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function comments()
     {
         return $this->hasMany(Comment::class);
     }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function photos()
     {
         return $this->hasMany(Photo::class);
     }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function photosAppearance()
     {
        return $this->belongsToMany(Photo::class)->using(PhotoUser::class)->withPivot("id")->withTimestamps();;

     }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function groups()
     {
        return $this->belongsToMany(Group::class)->using(GroupUser::class)->withPivot("id")->withTimestamps();;

     }
}
