<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_Post_Keyword
 * @property int $id_Post_Serie
 * @property int $nb
 * @property float $term_Frequency
 * @property Series $series
 * @property Keyword $keyword
 */
class Posting extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'posting';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nb', 'term_Frequency'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo('App\Series', 'id_Post_Serie', 'id_Serie');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function keyword()
    {
        return $this->belongsTo('App\Keyword', 'id_Post_Keyword', 'id_Word');
    }
}
