<?php

declare(strict_types=1);

namespace App\Providers;

use Akaza\Foundation\ServiceProvider;
use Akaza\Logging\Logger;


/**
 * Provider responsável pelo sistema
 * de logs da aplicação.
 */
final class LoggerServiceProvider extends ServiceProvider
{


    /**
     * Registra o Logger no Container.
     */
    public function register(): void
    {

        $this->container->singleton(
            Logger::class,
            function () {

                return new Logger();

            }
        );

    }


    /**
     * Inicialização do Logger.
     */
    public function boot(): void
    {

        /*
         * Futuramente:
         *
         * - definir canal padrão
         * - configurar nível de log
         * - carregar handlers
         */

    }

}