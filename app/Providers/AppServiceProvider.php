<?php

declare(strict_types=1);

namespace App\Providers;

use Akaza\Foundation\ServiceProvider;


/**
 * Provider principal da aplicação.
 *
 * Usado para registrar serviços
 * específicos do sistema.
 */
final class AppServiceProvider extends ServiceProvider
{

    /**
     * Registra serviços da aplicação.
     */
    public function register(): void
    {

        /**
         * Serviços da aplicação entram aqui.
         *
         * Exemplos futuros:
         *
         * - Configurações
         * - Eventos
         * - Helpers
         * - Módulos
         *
         */

    }


    /**
     * Inicializa serviços após registro.
     */
    public function boot(): void
    {

        /**
         * Inicializações da aplicação.
         *
         */

    }

}