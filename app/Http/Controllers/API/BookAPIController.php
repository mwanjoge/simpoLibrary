<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBookAPIRequest;
use App\Http\Requests\API\UpdateBookAPIRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BookResource;
use Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class BookController
 * @package App\Http\Controllers\API
 */

class BookAPIController extends AppBaseController
{
    /** @var  BookRepository */
    private $bookRepository;

    public function __construct(BookRepository $bookRepo)
    {
        $this->bookRepository = $bookRepo;
    }

     /**
     * @OA\Get(
     *      path="/books",
     *      operationId="getBookssList",
     *      tags={"Book"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index()
    {
        $books = $this->bookRepository->paginate(50);

        return $this->sendResponse(BookResource::collection($books), 'Books retrieved successfully');
    }

    /**
     * Display a listing of favourite books.
     * GET|HEAD /books/favourites
     *
     * @param Request $request
     * @return Response
     */
    public function mostLikedBooks(Request $request)
    {
        $books = Book::select('books.title','books.author')
            ->rightJoin('favourites','favourites.book_id','=','books.id')
            ->withCount('favourites')
            ->orderByRaw('favourites_count Desc')
            ->get();

        return $this->sendResponse($books, 'Books retrieved successfully');
    }

    /**
     * Store a newly created Book in storage.
     * POST /books
     *
     * @param CreateBookAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBookAPIRequest $request)
    {
        $input = $request->all();

        $book = $this->bookRepository->create($input);

        return $this->sendResponse(new BookResource($book), 'Book saved successfully');
    }

    /**
     * Display the specified Book.
     * GET|HEAD /books/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            return $this->sendError('Book not found');
        }

        return $this->sendResponse(new BookResource($book), 'Book retrieved successfully');
    }

    /**
     * Update the specified Book in storage.
     * PUT/PATCH /books/{id}
     *
     * @param int $id
     * @param UpdateBookAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookAPIRequest $request)
    {
        $input = $request->all();

        /** @var Book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            return $this->sendError('Book not found');
        }

        $book = $this->bookRepository->update($input, $id);

        return $this->sendResponse(new BookResource($book), 'Book updated successfully');
    }

    /**
     * Remove the specified Book from storage.
     * DELETE /books/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            return $this->sendError('Book not found');
        }

        $book->delete();

        return $this->sendSuccess('Book deleted successfully');
    }
}
