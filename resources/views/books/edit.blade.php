@extends('layouts.site')

@section('content')
    <main role="main">

        <div class="container">
            <!-- row of columns -->
            <div class="row">

                <div class="col-md-12">
                    <div class="title default">
                        <h3>Редактирование книги</h3>
                    </div>
                    <hr>
                </div>
                <div class="col-lg-9">
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
                    <form method="POST" action="{{ route('updateBook') }}" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Новое название</label>
                            <input type="text" class="form-control" name="title" value="{{ $book->title }}"
                                   aria-describedby="emailHelp" placeholder="Введите новое название произведения">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Авторы (для выбора нескольких авторов держите
                                ctrl)</label>
                            <select multiple="multiple" class="form-control" id="exampleFormControlSelect1"
                                    name="authors[ ]">
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}">{{ $author->surname }} {{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Рубрики (для выбора нескольких рубрик держите
                                ctrl)</label>
                            <select multiple="multiple" class="form-control" id="exampleFormControlSelect2"
                                    name="rubrics[ ]">
                                @foreach($rubrics as $rubric)
                                    <option value="{{$rubric->id}}">{{$rubric->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="custom-file">
                            <label class="custom-file-label" for="InputImage">Выберите изображение (.jpg, .jpeg)</label>
                            <input type="file" name="image" class="custom-file-input"
                                   placeholder="Выберите изображение">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="book_id" value={{ $book->id }}>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-md">Редактировать</button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>


        </div>


        </div> <!-- /container -->
    </main>

@endsection