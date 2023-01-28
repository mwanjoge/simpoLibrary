<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Favourite
 * @package App\Models
 * @version January 26, 2023, 11:04 am UTC
 *
 * @property \App\Models\User $user
 * @property \App\Models\Book $book
 * @property integer $user_id
 * @property integer $book_id
 */
class Favourite extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'favourites';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'book_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'book_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id', 'id');
    }
}
