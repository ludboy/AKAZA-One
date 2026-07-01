<?php

declare(strict_types=1);

namespace Akaza\Foundation;

use Akaza\Container\Container;

/**
 * Classe base para Service Providers.
 *
 * Providers são responsáveis por registrar
 * serviços dentro da aplicação.
 */
abstract class ServiceProvider
{
    /**
     * Aplicação.
     */
    protected Application $app;


    /**
     * Container da aplicação.
     */
    protected Container $container;


    /**
     * Cria um Provider.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->container = $app->container();
    }


    /**
     * Método executado durante o registro.
     *
     * Use para adicionar serviços ao Container.
     */
    public function register(): void
    {
        //
        // Implementação nos Providers filhos.
        //
    }


    /**
     * Método executado depois que todos
     * os serviços foram registrados.
     *
     * Use para inicializações.
     */
    public function boot(): void
    {
        //
        // Implementação opcional.
        //
    }


    /**
     * Retorna a aplicação.
     */
    public function app(): Application
    {
        return $this->app;
    }


    /**
     * Retorna o Container.
     */
    public function container(): Container
    {
        return $this->container;
    }
}