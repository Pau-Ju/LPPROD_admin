<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_Favorite_User
 * @property int $id_Favorite_Serie
 * @property Series $series
 * @property User $user
 */
class Favorite extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];
    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo('App\Series', 'id_Favorite_Serie', 'id_Serie');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_Favorite_User');
    }
}
