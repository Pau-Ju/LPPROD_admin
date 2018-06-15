<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id_Serie
 * @property string $name
 * @property int $maxNB
 * @property string $image_link
 * @property string $release_date
 * @property string $author
 * @property string $synopsis
 * @property Comment[] $comments
 * @property User[] $users
 * @property Note[] $notes
 * @property Posting[] $postings
 */
class Serie extends Model
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_Serie';
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
    protected $fillable = ['name', 'maxNB', 'image_link', 'release_date', 'author', 'synopsis'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'id_Comment_Serie', 'id_Serie');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'favorites', 'id_Favorite_Serie', 'id_Favorite_User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Note', 'id_Notes_Serie', 'id_Serie');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postings()
    {
        return $this->hasMany('App\Posting', 'id_Post_Serie', 'id_Serie');
    }

    /*---------------------- Special Functions ----------------------*/
    /**
     * @return mixed
     */
    public static function getSeriesHome()
    {
        $series = DB::SELECT("(SELECT s.name as name, s.id_Serie as id_Serie, s.image_link as image_link, cast(round(2*avg(notes.note))/2 as decimal(2,1)) as moyenne
                             FROM series as s, notes as notes
                             WHERE s.id_Serie = notes.id_Notes_Serie
                             GROUP BY s.name, s.image_link, s.id_Serie
                             ORDER BY s.name)
                             union
                             (SELECT se.name as name, se.id_Serie as id_Serie, se.image_link as image_link, 0 as moyenne
                             FROM series as se
                             WHERE se.id_Serie not in (SELECT  distinct notes.id_Notes_Serie as id_Serie 
													 FROM notes )
                             GROUP BY se.name, se.image_link, se.id_Serie
                             ORDER BY se.name)");
        return $series;
    }



    public static function getSeriesTop()    {
        $series = DB::select("(SELECT s.name as name, s.image_link as image_link, s.id_Serie as id_Serie,
                            cast(round(2*avg(notes.note))/2 as decimal(2,1)) as moyenne
                            FROM notes notes, series s
                            WHERE s.id_Serie = notes.id_Notes_Serie
                            GROUP BY s.image_link, s.name, s.id_Serie 
                            HAVING avg(notes.note)>3.5
                            ORDER BY moyenne desc)");
        return $series;
    }












    public static function getSearchResults($in)    {
        $series = DB::select("(SELECT s.id_Serie as id_Serie, s.name, s.image_link as url, sum(p.term_Frequency * k.idf) as score,
                                cast(round(2*avg(notes.note))/2 as decimal(2,1)) as moyenne
                                FROM posting p, series s, keywords k, notes notes
                                WHERE p.id_Post_Serie = s.id_Serie
                                AND p.id_Post_Keyword = k.id_Word
                                AND notes.id_Notes_Serie = s.id_Serie
                                AND k.libelle in (" . $in . ")
                                GROUP BY s.id_Serie , s.name,s.image_link
                                ORDER BY 2 DESC, 1)
                                UNION 
                                (SELECT s.id_Serie as id_Serie, s.name, s.image_link as url, sum(p.term_Frequency * k.idf) as score,
                                3 as moyenne
                                FROM posting p, series s, keywords k, notes notes
                                WHERE p.id_Post_Serie = s.id_Serie
                                AND p.id_Post_Keyword = k.id_Word
                                AND k.libelle in (" . $in . ")
                                AND s.id_Serie not in (SELECT  distinct notes.id_Notes_Serie as id_Serie 
													 FROM notes )
                                GROUP BY s.id_Serie , s.name,s.image_link
                                ORDER BY 2 DESC, 1)");
        return $series;
    }


}
