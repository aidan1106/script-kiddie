@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Laravel CRUD Application</h2>
        <a class="btn btn-success" href="{{ route('books.create') }}">Create New Book</a>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th width="280px">Actions</th>
            </tr>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
