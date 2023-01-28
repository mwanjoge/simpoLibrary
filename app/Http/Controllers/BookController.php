<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Repositories\BookRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Book;
use App\Repositories\FavouriteRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Eloquent\Builder;
use Response;

class BookController extends AppBaseController
{
    /** @var BookRepository $bookRepository*/
    private $bookRepository;

    public function __construct(BookRepository $bookRepo)
    {
        $this->middleware('auth');
        $this->bookRepository = $bookRepo;
    }

    /**
     * Display a listing of the Book.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $books = $this->bookRepository->paginate(50);

        return view('books.index')
            ->with('books', $books);
    }

    /**
     * Show the form for creating a new Book.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('manage_app');
        return view('books.create');
    }

    /**
     * Store a newly created Book in storage.
     *
     * @param CreateBookRequest $request
     *
     * @return Response
     */
    public function store(CreateBookRequest $request)
    {
        $this->authorize('manage_app');
        $input = $request->all();

        $book = $this->bookRepository->create($input);

        Flash::success('Book saved successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('manage_app');
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.edit')->with('book', $book);
    }

    /**
     * Update the specified Book in storage.
     *
     * @param int $id
     * @param UpdateBookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookRequest $request)
    {
        $this->authorize('manage_app');
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        $book = $this->bookRepository->update($request->all(), $id);

        Flash::success('Book updated successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Remove the specified Book from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('manage_app');
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        $this->bookRepository->delete($id);

        Flash::success('Book deleted successfully.');

        return redirect(route('books.index'));
    }


    /**
     * Remove the specified Book from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function toggleFavourite($id, FavouriteRepository $favouriteRepository)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        $favourite = $this->bookRepository->isFavourate($book);

        if($favourite){
            Flash::success("Your don't like the book now");
            $this->bookRepository->getFavourite($book)->delete();
        }
        else{
            Flash::success('This is your favourite book now');
            $favouriteRepository->create(['user_id' => Auth()->user()->id,'book_id' => $book->id]);
        }

        return back();
    }


}
