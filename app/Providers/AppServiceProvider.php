<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Barang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Tidak dipakai untuk View Composer
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View Composer Global
        // Variabel $stokMenipis bisa dipakai di SEMUA VIEW
        View::composer('*', function ($view) {
            $stokMenipis = Barang::where('stok', '<=', 5)->get();
            $view->with('stokMenipis', $stokMenipis);
        });
    }
}
