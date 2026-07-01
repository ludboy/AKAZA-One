<?php

declare(strict_types=1);

namespace App\Providers;

use Akaza\Foundation\ServiceProvider;
use Akaza\Database\Database;


/**
 * Provider responsável pelo banco de dados.
 *
 * Registra a conexão no Container
 * para uso global da aplicação.
 */
final class DatabaseServiceProvider extends ServiceProvider
{

    /**
     * Registra o serviço.
     */
    public function register(): void
    {

        $this->container->singleton(
            Database::class,
            function () {

                return new Database();

            }
        );

    }


    /**
     * Inicialização do serviço.
     */
    public function boot(): void
    {

        /*
         * Futuramente:
         *
         * - testar conexão
         * - carregar migrations
         * - eventos
         */

    }

}