<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastName', 'email', 'password', 'sex',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friendsOfOther()
    {
        return $this->belongsToMany(
            'App\User',
            'friends',
            'user_id',
            'friend_id'
        )->wherePivot('accepted', 1);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friendOfMine()
    {
        return $this->belongsToMany(
            'App\User',
            'friends',
            'friend_id',
            'user_id'
        )->wherePivot('accepted', 1);
    }

    /**
     * @return friends loged user
     */
    function friends() {
        return $this->friendsOfOther->merge($this->friendOfMine);
    }


    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('created_at', 'desc');
    }

    /* Odwrotna relacja w pliku medelu Post
        public function user()
    {
        return $this->belongsTo('App\User');
    }

    */

}
