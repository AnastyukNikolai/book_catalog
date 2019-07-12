@extends('layouts.site')

@section('content')
    <main role="main" class="content">

        <div class="container">
            <!-- row of columns -->
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger text-center msg" id="error">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{Session::get('success')}}</li>
                    </ul>
                </div>
            @endif

            <div class="row">
                    <div class="title default col-md-12">
                        <h3>Книги автора {{ $author->surname }} {{ $author->name }}</h3>
                        <hr>
                    </div>
            </div>

            @foreach($books as $book)
            <div class="row book-main-block">
                <div class="col-md-5" style="padding-right: 5%">
                    <div class="book-photo text-center">
                        <div class="image-wrapper">
                            <img alt="{{ $book->title }}"
                                 src="{{ \Storage::disk('public')->url($book->image_path) }}"
                                 class="book-img">
                        </div>
                    </div>
                </div>
                <div class="book__cont col-md-5">
                    <h2 style="color: #008080; text-align: center; margin-top: 5px"
                        class="book-heading">{{ $book->title }}</h2>
                    <hr color="green" height="bold">
                    <div class="book__info default">
                        <div class="book__block-item">
                            <div class="book__block-name">Авторы:</div>
                            <div class="book__block-genre">|
                                @foreach($book->authors as $author)
                                    {{ $author->name }} {{ $author->surname }} |
                                @endforeach
                            </div>
                        </div>
                        <hr color="green">
                        <div class="book__block-item">
                            <div class="book__block-name">Рубрики:</div>
                            <div class="book__block-genre">|
                                @foreach($book->rubrics as $rubric) {{ $rubric->title }} | @endforeach
                            </div>
                        </div>
                        <hr color="green">
                        <div class="book__block-item book__block-star clearfix">
                            <div class="book__block-name">Опубликовано:</div>
                            <div align="right"
                                 class="book__block-time time-green pull-right">{{$book->created_at}}</div>
                        </div>
                        <hr color="green">
                        <div class="book_read text-center default" style="margin-top: 10px">
                            @if(Auth::check())
                                <div style="display: inline-block">
                                    <a class="btn btn-outline-warning btn-block btn-sm" href="{{ route('editBook', ['id'=>$book->id]) }}">
                                        <span>Редактировать информацию о книге</span>
                                    </a>
                                </div>
                                <div style="display: inline-block">
                                    <a class="btn btn-outline-danger btn-block btn-sm" href="{{ route('deleteBook', ['id'=>$book->id]) }}">
                                        <span>Удалить книгу</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
                <hr>
        @endforeach

        </div> <!-- /container -->
    </main>

@endsection