<?php

declare(strict_types=1);

namespace Akaza\Routing;


/**
 * Coleção de rotas da aplicação.
 *
 * Responsável por armazenar
 * e localizar rotas registradas.
 */
final class RouteCollection
{

    /**
     * Rotas cadastradas.
     *
     * @var array<int,Route>
     */
    private array $routes = [];


    /**
     * Adiciona uma rota.
     */
    public function add(
        Route $route
    ): void {

        $this->routes[] = $route;
    }



    /**
     * Procura uma rota compatível.
     */
    public function match(
        string $method,
        string $uri
    ): ?Route {


        foreach ($this->routes as $route) {


            if (
                $route->matches(
                    $method,
                    $uri
                )
            ) {

                return $route;
            }
        }


        return null;
    }



    /**
     * Retorna todas as rotas.
     *
     * @return array<int,Route>
     */
    public function all(): array
    {
        return $this->routes;
    }



    /**
     * Quantidade de rotas.
     */
    public function count(): int
    {
        return count($this->routes);
    }

}