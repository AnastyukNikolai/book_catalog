@extends('layouts.site')

@section('content')
    <main role="main">

        <div class="container">
            <!-- row of columns -->
            <div class="row">

                <div class="col-md-12">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                        <div class="title default col-7">
                            <h3>{{ $message }}</h3>
                        </div>
                        <div class="col-md-5 text-right">
                            @can('addBook')
                            <a class="btn btn-outline-success btn-md" href="{{ route('addBook') }}">Добавить книгу</a>
                            @endcan
                        </div>
                    </div>
                    <hr>
                </div>

                @foreach($books as $book)
                    <div class="col-md-3 col-sm-4 col-xs-6 book-block">
                        <div class="renewal-item">
                            <div class="renewal-img">
                                <img class="book-img-main" alt="{{ $book->title }}"
                                     src="{{ \Storage::disk('public')->url($book->image_path) }}">
                            </div>
                        </div>
                        <div>
                            <h4 style="color: #218838;text-decoration: none">
                                <a style="color: #218838" href="{{ route('showBook', ['id'=>$book->id]) }}">{{ $book->title }}</a>
                            </h4>
                        </div>
                    </div>
                @endforeach

            </div>

        </div> <!-- /container -->

    </main>

@endsection