
@extends('layouts.admin')

@section('content_admin')

    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Cines</h2>
                        <span class="main__title-stat">3,702 Total</span>
                    </div>
                </div>
                <div id="app">
                    <cinema-component></cinema-component> 
                       
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection