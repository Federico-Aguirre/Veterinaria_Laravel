<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        View::composer('*', function ($view) {
            $cantidad = 0;
    
            if (Auth::check()) {
                $idCliente = Auth::id();
                $cantidad = DB::table('carro_de_compras')
                    ->where('id_cliente', $idCliente)
                    ->sum('producto_cantidad');
            }
    
            $view->with('cantidadDeProductosEnCarro', $cantidad);
        });
    }
}
