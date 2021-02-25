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

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="https://www.launion.com.gt/wp-content/uploads/2019/01/ICONO-100x100.png" sizes="32x32">
    <link rel="apple-touch-icon" href="https://www.launion.com.gt/wp-content/uploads/2019/01/ICONO-100x100.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Vinicio Lopez">
    <title>Cines La Unión</title>

</head>
<body>

    <!-- header -->
    <header class="header">
        <div class="header__content">
            <!-- header logo -->
            <a href="index.html" class="header__logo">
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
        <a href="index.html" class="sidebar__logo">
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

            <button class="sidebar__user-btn" type="button">
                <i class="icon ion-ios-log-out"></i>
            </button>
        </div>
        <!-- end sidebar user -->

        <!-- sidebar nav -->
        <ul class="sidebar__nav">
            <li class="sidebar__nav-item">
                <a href="index.html" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-keypad"></i> Dashboard</a>
            </li>

            <li class="sidebar__nav-item">
                <a href="{{ route('movies') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Cines</a>
            </li>
            
            <li class="sidebar__nav-item">
                <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-copy"></i> Salas</a>
            </li>

            <li class="sidebar__nav-item">
                <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Asientos</a>
            </li>

            <li class="sidebar__nav-item">
                <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-film"></i> Peliculas</a>
            </li>

            <li class="sidebar__nav-item">
                <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Cartelera</a>
            </li>

            <li class="sidebar__nav-item">
                <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Usuarios</a>
            </li>

            <li class="sidebar__nav-item">
                <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Departamentos</a>
            </li>

            <li class="sidebar__nav-item">
                <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-coments"></i> Municipios</a>
            </li>

           
        </ul>
        <!-- end sidebar nav -->
        
        <!-- sidebar copyright -->
        <div class="sidebar__copyright">© 2020 ILU. <br>Create by <a href="" target="_blank">Vinicio Lopez</a></div>
        <!-- end sidebar copyright -->
    </div>
    <!-- end sidebar -->

    <!-- main content -->
    @yield('content')
   
    <!-- end main content -->

    <!-- JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/jquery.mousewheel.min.js"></script>
    <script src="../js/jquery.mCustomScrollbar.min.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/admin.js"></script>
</body>
</html>