<?php namespace Tests\Repositories;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BookRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BookRepository
     */
    protected $bookRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bookRepo = \App::make(BookRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_book()
    {
        $book = Book::factory()->make()->toArray();

        $createdBook = $this->bookRepo->create($book);

        $createdBook = $createdBook->toArray();
        $this->assertArrayHasKey('id', $createdBook);
        $this->assertNotNull($createdBook['id'], 'Created Book must have id specified');
        $this->assertNotNull(Book::find($createdBook['id']), 'Book with given id must be in DB');
        $this->assertModelData($book, $createdBook);
    }

    /**
     * @test read
     */
    public function test_read_book()
    {
        $book = Book::factory()->create();

        $dbBook = $this->bookRepo->find($book->id);

        $dbBook = $dbBook->toArray();
        $this->assertModelData($book->toArray(), $dbBook);
    }

    /**
     * @test update
     */
    public function test_update_book()
    {
        $book = Book::factory()->create();
        $fakeBook = Book::factory()->make()->toArray();

        $updatedBook = $this->bookRepo->update($fakeBook, $book->id);

        $this->assertModelData($fakeBook, $updatedBook->toArray());
        $dbBook = $this->bookRepo->find($book->id);
        $this->assertModelData($fakeBook, $dbBook->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_book()
    {
        $book = Book::factory()->create();

        $resp = $this->bookRepo->delete($book->id);

        $this->assertTrue($resp);
        $this->assertNull(Book::find($book->id), 'Book should not exist in DB');
    }
}
