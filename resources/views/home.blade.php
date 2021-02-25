
@extends('layouts.admin')

@section('content')
 <main class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="main__title">
                        <h2>Inicio</h2>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('logout') }}" class="main__title-link">Cerrar sesión</a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de cines</span>
                        <p>{{ Session::get('total_cinema') }}</p>
                        <i class="icon ion-ios-stats"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de salas de cine</span>
                        <p>{{ Session::get('total_room') }}</p>
                        <i class="icon ion-ios-film"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de peliculas</span>
                        <p>{{ Session::get('total_movie') }}</p>
                        <i class="icon ion-ios-chatbubbles"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de ventas</span>
                        <p>{{ Session::get('total_invoice') }}</p>
                        <i class="icon ion-ios-star-half"></i>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3><i class="icon ion-ios-trophy"></i> Ultimos cines</h3>
                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="catalog.html">Ver todos</a>
                            </div>
                        </div>
                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>TELEFONO</th>
                                        <th>SALAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_cinemas as $item)
                                        <tr>
                                        <td>
                                            <div class="main__table-text">{{ $item->cinema_id}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->name}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->phone}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->count_room}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3><i class="icon ion-ios-film"></i> Ultimas Peliculas</h3>

                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="catalog.html">Ver todos</a>
                            </div>
                        </div>

                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITULO</th>
                                        <th>GENERO</th>
                                        <th>CLASIFICACION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_movies as $item)
                                        <tr>
                                        <td>
                                            <div class="main__table-text">{{ $item->movie_id}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->title}}</div>
                                        </td>
                                        <td>
                                            @if($item->gender == 1) <div class="main__table-text">Accion</div>@endif
                                            @if($item->gender == 2) <div class="main__table-text">Comedia</div>@endif
                                            @if($item->gender == 3) <div class="main__table-text">Suspenso</div>@endif
                                            @if($item->gender != 1 && $item->gender != 2 && $item->gender != 3 ) <div class="main__table-text">Otro</div>@endif
                                        </td>
                                        <td>
                                            @if($item->gender == 1) <div class="main__table-text">B</div>@endif
                                            @if($item->gender == 2) <div class="main__table-text">C</div>@endif
                                            @if($item->gender == 3) <div class="main__table-text">D</div>@endif
                                            @if($item->gender != 1 && $item->gender != 2 && $item->gender != 3 ) <div class="main__table-text">Otro</div>@endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3><i class="icon ion-ios-contacts"></i> Ultimas compras</h3>

                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="users.html">Ver todos</a>
                            </div>
                        </div>

                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>FACTURA</th>
                                        <th>PELICULA</th>
                                        <th>ASIENTOS</th>
                                        <th>FECHA</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    @foreach ($list_sell as $item)
                                        <tr>
                                        <td>
                                            <div class="main__table-text">#{{ $item->invoice_id}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->movie}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->seats}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->created_at}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3><i class="icon ion-ios-star-half"></i> Ultimos usuarios</h3>
                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="reviews.html">Ver todos</a>
                            </div>
                        </div>
                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>FECHA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_users as $item)
                                        <tr>
                                        <td>
                                            <div class="main__table-text">{{ $item->user_id}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->name}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $item->created_at}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->
            </div>
        </div>
    </main>
@endsection