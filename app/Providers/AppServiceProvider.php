<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Barang;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            // CEK DULU TABEL BARANG ADA ATAU TIDAK
            if (Schema::hasTable('barang')) {
                $stokMenipis = Barang::where('stok', '<=', 5)->get();
            } else {
                $stokMenipis = collect(); // kosong, biar aman
            }

            $view->with('stokMenipis', $stokMenipis);
        });
    }
}
