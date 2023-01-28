<div class="table-responsive">
    <table class="table" id="favourites-table">
        <thead>
        <tr>
            <th>User Id</th>
        <th>Book Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($favourites as $favourite)
            <tr>
                <td>{{ $favourite->user_id }}</td>
            <td>{{ $favourite->book_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['favourites.destroy', $favourite->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('favourites.show', [$favourite->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('favourites.edit', [$favourite->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
