<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        factory(App\Models\Cinema::class, 2)->create();
        factory(App\Models\Bilboard::class, 2)->create();
        factory(App\Models\CinemaRoom::class, 2)->create();
        factory(App\Models\Client::class, 2)->create();
        factory(App\Models\Departament::class, 2)->create();
        factory(App\Models\Municipality::class, 2)->create();
        factory(App\Models\DetailInvoice::class, 2)->create();
        factory(App\Models\Invoice::class, 2)->create();
        factory(App\Models\Movie::class, 2)->create();
        factory(App\Models\Seat::class, 50)->create();
        factory(App\Models\SeatInvoice::class, 2)->create();
        factory(App\Models\User::class, 2)->create();
    }

}
