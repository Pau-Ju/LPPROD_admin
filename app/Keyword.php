<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_Word
 * @property string $libelle
 * @property float $idf
 * @property Posting[] $postings
 */
class Keyword extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_Word';
    public $timestamps = false;

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['libelle', 'idf'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postings()
    {
        return $this->hasMany('App\Posting', 'id_Post_Keyword', 'id_Word');
    }
}
