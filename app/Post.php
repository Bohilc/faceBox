<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'content', 'user_id'
    ];

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
        /*
         * odnosie się do modelu User tabeli user_id. Jeśli user_id nazywałó by się
         * inaczej to przekazali by 2 parametry np.: $this->belongsTo('App\User', 'nazwa_rekordu_klucza_obcego_z_id_user')
         * */
    }

    /* Odwrotna relacja w pliku medwlu User
         public function posts()
    {
        return $this->hasMany('App\Post');
    }

    */

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }
}
