<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_Comment
 * @property int $id_Comment_User
 * @property int $id_Comment_Serie
 * @property string $comment
 * @property User $user
 * @property Series $series
 */
class Comment extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_Comment';

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['id_Comment_User', 'id_Comment_Serie', 'comment'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_Comment_User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo('App\Series', 'id_Comment_Serie', 'id_Serie');
    }
}
