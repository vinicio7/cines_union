<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="https://www.launion.com.gt/wp-content/uploads/2019/01/ICONO-100x100.png" sizes="32x32">
    <link rel="apple-touch-icon" href="https://www.launion.com.gt/wp-content/uploads/2019/01/ICONO-100x100.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Vinicio Lopez">
    <title>Cines La Unión</title>
    <style type="text/css">
        .main{
             background-color: #28292d;
        }
        .btn-success{
             background-color: #77a62e;
             border-color: #77a62e;
        }
        td{
            color:white;
        }
        th{
            color:white;
        }
        
    </style>
</head>
<body>

    <!-- header -->
    <header class="header">
        <div class="header__content">
            <!-- header logo -->
            <a href="{{ route('home') }}" class="header__logo">
                <img src="https://www.launion.com.gt/wp-content/uploads/2019/01/ICONO-100x100.png" alt="">
            </a>
            <!-- end header logo -->

            <!-- header menu btn -->
            <button class="header__btn" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <!-- end header menu btn -->
        </div>
    </header>
    <!-- end header -->

    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar logo -->
        <a href="{{ route('home') }}" class="sidebar__logo">
            <img src="https://www.launion.com.gt/wp-content/uploads/2019/01/ICONO-100x100.png" style="width:30%">
        </a>
        <!-- end sidebar logo -->
        
        <!-- sidebar user -->
        <div class="sidebar__user">
            <div class="sidebar__user-img">
                <img src="../img/user.svg" alt="">
            </div>

            <div class="sidebar__user-title">
                <span>User</span>
                <p>{{ Session::get('user')->name }}</p>
            </div>

            <a class="sidebar__user-btn" type="button" href="{{ route('logout') }}">
                <i class="icon ion-ios-log-out"></i>
            </a>
        </div>
        <!-- end sidebar user -->

        <!-- sidebar nav -->
        <ul class="sidebar__nav">
            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('home') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-keypad"></i> Dashboard</a>
                @else
                    <a href="{{ route('home') }}" class="sidebar__nav-link "><i class="icon ion-ios-keypad"></i> Dashboard</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'cinemas')
                    <a href="{{ route('cinemas') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Cines</a>
                @else
                    <a href="{{ route('cinemas') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Cines</a>
                @endif
            </li>
            
            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'cinemas/room')
                    <a href="{{ route('cinemas/room') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-copy"></i> Salas</a>
                @else()
                    <a href="{{ route('cinemas/room') }}" class="sidebar__nav-link"><i class="icon ion-ios-copy"></i> Salas</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'seats')
                    <a href="{{ route('seats') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-contacts"></i> Asientos</a>
                @else
                    <a href="{{ route('seats') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Asientos</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'movies')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-film"></i> Peliculas</a>
                @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-film"></i> Peliculas</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                 @if(Request::route()->getName() == 'bilboard')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Cartelera</a>
                 @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Cartelera</a>
                 @endif
            </li>

            <li class="sidebar__nav-item">
                 @if(Request::route()->getName() == 'users')
                    <a href="{{ route('users') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-contacts"></i> Usuarios</a>
                 @else
                    <a href="{{ route('users') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Usuarios</a>
                 @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'departaments')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-contacts"></i> Departamentos</a>
                @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Departamentos</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'municipalitys')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-contacts"></i> Municipios</a>
                @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Municipios</a>
                @endif
            </li>

           
        </ul>
        <!-- end sidebar nav -->
        
        <!-- sidebar copyright -->
        <div class="sidebar__copyright">© 2020 ILU. <br>Create by <a href="" target="_blank">Vinicio Lopez</a></div>
        <!-- end sidebar copyright -->
    </div>
    <!-- end sidebar -->

    <!-- main content -->
    @yield('content_admin')
   
    <!-- end main content -->

    <!-- JS -->
</body>
</html>