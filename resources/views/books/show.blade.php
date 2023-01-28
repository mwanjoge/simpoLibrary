@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Book Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('books.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('books.show_fields')
                    <div class="col">
                        <button class="btn btn-primary">{{$book->comments->count()}} Comments</button>
                    &ensp;
                    <button class="btn bg-pink">{{$book->favourites->count()}} favourites</button>
                    <a class="float-right" href="{{route('book.favourite.toggle',$book->id)}}">
                        <i class="fa fa-heart {{$book->favourites->contains('user_id', Auth()->user()->id) ? 'text-pink' : 'text-secondary'}}"></i>
                    </a>

                    <div class="card mt-3">
                        <div class="card-header">Comments</div>
                        <div class="card-body" style="height: 400px;overflow-y:auto;">
                            @foreach ($book->comments->sortByDesc('id') as $comment)
                                <strong class="text-secondary">{{$comment->user->name}}</strong>
                                <textarea name="title" class="form-control" disabled>{{$comment->title}}</textarea>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form action="{{route('comments.store')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{Auth()->user()->id}}" name="user_id">
                                <input type="hidden" value="{{$book->id}}" name="book_id">
                                <div class="form-group">
                                    <label><small>Comment</small></label>
                                <textarea name="title" class="form-control"></textarea>
                                </div>
                                <input type="submit" value="comment" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
