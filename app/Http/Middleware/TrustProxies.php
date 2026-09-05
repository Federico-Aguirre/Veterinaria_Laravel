<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * Los proxies confiables para esta aplicación.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * Los encabezados que deben usarse para detectar el proxy.
     *
     * @var int
     */
    protected $headers = 0x3F;

}
