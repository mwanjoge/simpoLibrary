<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $book->title }}</p>
</div>

<!-- Author Field -->
<div class="col-sm-12">
    {!! Form::label('author', 'Author:') !!}
    <p>{{ $book->author }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $book->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $book->updated_at }}</p>
</div>

