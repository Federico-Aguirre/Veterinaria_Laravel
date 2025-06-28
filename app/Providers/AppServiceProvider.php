<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

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
    public function boot(): void
    {
        if (app()->environment('production')) {
            \Illuminate\Http\Request::setTrustedProxies(
                [request()->getClientIp()],
                SymfonyRequest::HEADER_FORWARDED |
                SymfonyRequest::HEADER_X_FORWARDED_FOR |
                SymfonyRequest::HEADER_X_FORWARDED_HOST |
                SymfonyRequest::HEADER_X_FORWARDED_PROTO
            );

            URL::forceScheme('https');
        }
        View::composer('*', function ($view) {
            $cantidad = 0;

            if (Auth::check()) {
                $idCliente = Auth::user()->id;
                try {
                    $cantidad = DB::table('carro_de_compras')
                        ->where('id_cliente', $idCliente)
                        ->sum('producto_cantidad');
                } catch (\Exception $e) {
                    dd('Error en el sum():', $e->getMessage());
                }
            }

            $view->with('cantidadDeProductosEnCarro', $cantidad);
        });
    }
}