@extends('layouts.site')

@section('content')
    <main role="main">

        <div class="container">
            <!-- row of columns -->
            <div class="row">
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
                <div class="col-md-12">
                    <div class="row">
                        <div class="title default col-6">
                            <h3>{{ $message }}</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            @if (Auth::check()&&Auth::user()->role == 'administrator')
                            <form class="form-inline" method="POST"
                                  action="{{ route('storeAuthor') }}">
                                <div class="form-group">
                                    <input type="text" name="surname" class="form-control"
                                           placeholder="Введите фамилию">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Введите имя">
                                </div>
                                <div class="form-group" style="margin-right: 5px">
                                    <input type="hidden" name="user_id"
                                           value={{ Auth::id() }}>
                                </div>

                                <button style="text-align: right" type="submit"
                                        class="btn btn-outline-success text-right">Добавить автора
                                </button>
                                {{ csrf_field() }}
                            </form>
                            @endif
                        </div>
                    </div>
                    <hr>
                </div>

                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Фамилия</th>
                        <th class="text-center" scope="col">Имя</th>
                        @if (Auth::check()&&Auth::user()->role == 'administrator')
                            <th scope="col">Редактирование информации об авторе</th>
                            <th class="text-center" scope="col">Удалить автора</th>
                        @endif
                        <th class="text-center" scope="col">Страница автора</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <th class="text-center" scope="row">{{ $n }}</th>
                            <td class="text-center">{{ $author->surname }}</td>
                            <td class="text-center">{{ $author->name }}</td>
                            @if (Auth::check()&&Auth::user()->role == 'administrator')
                                <td class="text-right">
                                    <form class="form-inline" method="POST"
                                          action="{{ route('updateAuthor', ['id' => $author->id]) }}">
                                        <div class="form-group">
                                            <input type="text" name="surname" class="form-control"
                                                   placeholder="Введите новую фамилию">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Введите новое имя">
                                        </div>
                                        <div class="form-group" style="margin-right: 5px">
                                            <input type="hidden" name="author_id"
                                                   value={{ $author->id }}>
                                        </div>

                                        <button style="text-align: right" type="submit"
                                                class="btn btn-outline-warning btn-sm text-right">Редактировать
                                        </button>
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block btn-sm"
                                       href="{{ route('deleteAuthor', ['id'=>$author->id]) }}">
                                        <span>Удалить</span>
                                    </a>
                                </td>
                            @endif
                            <td>
                                <a class="btn btn-outline-primary btn-block btn-sm"
                                   href="{{ route('showAuthor', ['id'=>$author->id]) }}">
                                    <span>Перейти</span>
                                </a>
                            </td>
                        </tr>
                        <div style="display: none">{{ $n+=1 }}</div>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div> <!-- /container -->

    </main>

@endsection