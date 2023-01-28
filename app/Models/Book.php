<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Book
 * @package App\Models
 * @version January 26, 2023, 11:03 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $favourites
 * @property \Illuminate\Database\Eloquent\Collection $comments
 * @property string $title
 * @property string $author
 */
class Book extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'books';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'author'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'author' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'author' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function favourites()
    {
        return $this->hasMany(\App\Models\Favourite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
