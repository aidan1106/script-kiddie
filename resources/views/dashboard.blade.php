@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome to your dashboard. Here you can manage your books.</p>
        <a class="btn btn-primary" href="{{ route('books.index') }}">Manage Books</a>
    </div>
@endsection
