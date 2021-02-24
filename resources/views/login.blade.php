
@extends('layouts.app')

@section('content')

<div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <script>
                          @if(Session::has('success'))
                                toastr.success("{{ Session::get('success') }}");
                          @endif


                          @if(Session::has('info'))
                                toastr.info("{{ Session::get('info') }}");
                          @endif


                          @if(Session::has('warning'))
                                toastr.warning("{{ Session::get('warning') }}");
                          @endif


                          @if(Session::has('error'))
                                toastr.error("{{ Session::get('error') }}");
                          @endif
                        </script>
                        <form method="POST" action="{{ route('autenticar') }}" class="sign__form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="index.html" class="sign__logo">
                                <img src="https://www.launion.com.gt/wp-content/uploads/2019/01/ICONO-100x100.png" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Usuario" id="user" name="user">
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" placeholder="Contraseña" id="password" name="password">
                            </div>

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox" checked="checked">
                                <label for="remember">Recuerdame</label>
                            </div>
                            
                            <button class="sign__btn" type="submit">Iniciar sesión</button>
                            <span class="sign__text"><a href="forgot.html">Olvido su contraseña?</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection