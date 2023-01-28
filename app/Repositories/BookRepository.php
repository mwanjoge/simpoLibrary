<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Favourite;
use App\Repositories\BaseRepository;

/**
 * Class BookRepository
 * @package App\Repositories
 * @version January 26, 2023, 11:03 am UTC
*/

class BookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'author'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Return boolean if user make this book favourite
     *
     * @param $bookId book id
     *
     */
    public function isFavourate($book){
        return $book->favourites->contains('user_id', Auth()->user()->id);
    }

    public function getFavourite($book){
        return $book->favourites->firstWhere("user_id",Auth()->user()->id);
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Book::class;
    }
}
