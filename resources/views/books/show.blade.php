@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Show Book</h2>
        <div class="jumbotron text-center">
            <h3>{{ $book->title }}</h3>
            <p>
                <strong>Author:</strong> {{ $book->author }}
            </p>
        </div>
    </div>
@endsection
