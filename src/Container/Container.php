<?php

declare(strict_types=1);

namespace Akaza\Container;

use Closure;
use ReflectionClass;
use ReflectionException;
use RuntimeException;

/**
 * Container de Inversão de Controle (IoC).
 *
 * Responsável por resolver e armazenar
 * dependências da aplicação.
 */
final class Container
{
    /**
     * Serviços registrados.
     *
     * @var array<string, Closure|string>
     */
    private array $bindings = [];


    /**
     * Serviços singleton.
     *
     * @var array<string, bool>
     */
    private array $singletons = [];


    /**
     * Instâncias já criadas.
     *
     * @var array<string, mixed>
     */
    private array $instances = [];


    /**
     * Registra uma dependência.
     */
    public function bind(
        string $abstract,
        Closure|string $concrete
    ): void {

        $this->bindings[$abstract] = $concrete;
    }


    /**
     * Registra uma dependência singleton.
     *
     * Singleton cria apenas uma instância.
     */
    public function singleton(
        string $abstract,
        Closure|string $concrete
    ): void {

        $this->bindings[$abstract] = $concrete;

        $this->singletons[$abstract] = true;
    }


    /**
     * Adiciona uma instância existente.
     */
    public function instance(
        string $abstract,
        mixed $instance
    ): void {

        $this->instances[$abstract] = $instance;
    }


    /**
     * Resolve uma dependência.
     *
     * @throws RuntimeException
     */
    public function make(
        string $abstract
    ): mixed {


        /**
         * Se já existe instância,
         * retorna diretamente.
         */
        if ($this->hasInstance($abstract)) {

            return $this->instances[$abstract];

        }


        /**
         * Se existe binding registrado,
         * usa a implementação.
         */
        if (isset($this->bindings[$abstract])) {

            $concrete = $this->bindings[$abstract];


            if ($concrete instanceof Closure) {

                $object = $concrete($this);

            } else {

                $object = $this->build($concrete);

            }


            if ($this->isSingleton($abstract)) {

                $this->instances[$abstract] = $object;

            }


            return $object;
        }


        /**
         * Caso contrário tenta criar
         * automaticamente.
         */
        return $this->build($abstract);
    }


    /**
     * Cria uma classe automaticamente.
     *
     * Usa Reflection para resolver
     * dependências do construtor.
     */
    private function build(
        string $concrete
    ): mixed {

        try {


            $reflection = new ReflectionClass($concrete);


            if (!$reflection->isInstantiable()) {

                throw new RuntimeException(
                    "Classe {$concrete} não pode ser criada."
                );

            }


            $constructor = $reflection->getConstructor();


            if ($constructor === null) {

                return new $concrete();

            }


            $dependencies = [];


            foreach ($constructor->getParameters() as $parameter) {


                $type = $parameter->getType();


                if ($type === null) {

                    if ($parameter->isDefaultValueAvailable()) {

                        $dependencies[] =
                            $parameter->getDefaultValue();

                        continue;
                    }


                    throw new RuntimeException(
                        "Não foi possível resolver {$parameter->name}"
                    );
                }


                $dependencies[] =
                    $this->make($type->getName());
            }


            return $reflection->newInstanceArgs(
                $dependencies
            );


        } catch (ReflectionException $exception) {


            throw new RuntimeException(
                $exception->getMessage(),
                0,
                $exception
            );

        }
    }


    /**
     * Verifica se existe no Container.
     */
    public function has(
        string $abstract
    ): bool {

        return isset($this->bindings[$abstract])
            || $this->hasInstance($abstract);
    }


    /**
     * Verifica se existe instância criada.
     */
    private function hasInstance(
        string $abstract
    ): bool {

        return array_key_exists(
            $abstract,
            $this->instances
        );
    }


    /**
     * Verifica singleton.
     */
    private function isSingleton(
        string $abstract
    ): bool {

        return isset(
            $this->singletons[$abstract]
        );
    }
}