<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_Notes_User
 * @property int $id_Notes_Serie
 * @property int $note
 * @property Series $series
 * @property User $user
 */
class Note extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['note'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo('App\Series', 'id_Notes_Serie', 'id_Serie');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_Notes_User');
    }
}
