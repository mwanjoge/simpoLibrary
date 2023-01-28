@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col">
            <h1>
                {{'Welcome '.Auth()->user()->name.' !'}}
            </h1>
        </div>
    </div>
</div>
@endsection
