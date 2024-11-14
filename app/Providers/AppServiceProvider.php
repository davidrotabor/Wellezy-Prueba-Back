<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    /**
 * @OA\Info(
 *     title="API de Gestión de Vuelos",
 *     version="1.0.0",
 *     description="Esta es la documentación de la API para gestionar vuelos, desarrollada en Laravel.",
 *     @OA\Contact(
 *         email="soporte@example.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

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
     Schema::defaultStringLength(191);
    }
}
