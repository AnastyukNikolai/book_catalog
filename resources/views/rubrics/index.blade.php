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
                        <div class="title default col-md-8">
                            <h3>{{ $message }}</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            @if (Auth::check()&&Auth::user()->role == 'administrator')
                                <form class="form-inline" method="POST"
                                      action="{{ route('storeRubric') }}">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control"
                                               placeholder="Введите название рубрики">
                                    </div>
                                    <div class="form-group" style="margin-right: 5px">
                                        <input type="hidden" name="user_id"
                                               value={{ Auth::id() }}>
                                    </div>

                                    <button style="text-align: right" type="submit"
                                            class="btn btn-outline-success text-right">Добавить рубрику
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
                        <th class="text-center" scope="col">Название рубрики</th>
                        @if (Auth::check()&&Auth::user()->role == 'administrator')
                            <th scope="col">Редактирование информации о рубрике</th>
                            <th class="text-center" scope="col">Удалить рубрику</th>
                        @endif
                        <th class="text-center" scope="col">Страница рубрики</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rubrics as $rubric)
                        <tr>
                            <th class="text-center" scope="row">{{ $n }}</th>
                            <td class="text-center">{{ $rubric->title }}</td>
                            @if (Auth::check()&&Auth::user()->role == 'administrator')
                                <td class="text-right">
                                    <form class="form-inline" method="POST"
                                          action="{{ route('updateRubric', ['id' => $rubric->id]) }}">
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control"
                                                   placeholder="Введите нове название">
                                        </div>
                                        <div class="form-group" style="margin-right: 5px">
                                            <input type="hidden" name="rubric_id"
                                                   value={{ $rubric->id }}>
                                        </div>

                                        <button style="text-align: right" type="submit"
                                                class="btn btn-outline-warning btn-sm text-right">Редактировать
                                        </button>
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block btn-sm"
                                       href="{{ route('deleteRubric', ['id'=>$rubric->id]) }}">
                                        <span>Удалить</span>
                                    </a>
                                </td>
                            @endif
                            <td>
                                <a class="btn btn-outline-primary btn-block btn-sm"
                                   href="{{ route('showRubric', ['id'=>$rubric->id]) }}">
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