<?php

declare(strict_types=1);

namespace Akaza\Foundation;

use Akaza\Container\Container;
use RuntimeException;

/**
 * Classe principal da aplicação.
 *
 * Responsável por inicializar a plataforma,
 * registrar os Service Providers
 * e executar o Kernel.
 */
final class Application
{
    /**
     * Caminho raiz do projeto.
     */
    private string $basePath;

    /**
     * Container de Inversão de Controle.
     */
    private Container $container;

    /**
     * Kernel da aplicação.
     */
    private Kernel $kernel;

    /**
     * Providers registrados.
     *
     * @var ServiceProvider[]
     */
    private array $providers = [];

    /**
     * Indica se a aplicação já foi inicializada.
     */
    private bool $booted = false;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, DIRECTORY_SEPARATOR);

        $this->container = new Container();

        $this->kernel = new Kernel($this);

        /**
         * Disponibiliza a própria aplicação
         * dentro do Container.
         */
        $this->container->instance(self::class, $this);

        $this->container->instance(Container::class, $this->container);

        $this->container->instance(Kernel::class, $this->kernel);
    }

    /**
     * Caminho base do projeto.
     */
    public function basePath(string $path = ''): string
    {
        if ($path === '') {
            return $this->basePath;
        }

        return $this->basePath
            . DIRECTORY_SEPARATOR
            . ltrim($path, DIRECTORY_SEPARATOR);
    }

    /**
     * Retorna o Container.
     */
    public function container(): Container
    {
        return $this->container;
    }

    /**
     * Registra um Service Provider.
     */
    public function register(ServiceProvider $provider): static
    {
        $provider->register();

        $this->providers[] = $provider;

        return $this;
    }

    /**
     * Inicializa todos os Providers.
     */
    public function boot(): void
    {
        if ($this->booted) {
            return;
        }

        foreach ($this->providers as $provider) {
            $provider->boot();
        }

        $this->booted = true;
    }

    /**
     * Executa a aplicação.
     */
    public function run(): void
    {
        $this->boot();

        $this->kernel->handle();
    }

    /**
     * Obtém um serviço do Container.
     *
     * @throws RuntimeException
     */
    public function make(string $abstract): mixed
    {
        return $this->container->make($abstract);
    }

    /**
     * Verifica se um serviço existe.
     */
    public function has(string $abstract): bool
    {
        return $this->container->has($abstract);
    }

    /**
     * Retorna o Kernel.
     */
    public function kernel(): Kernel
    {
        return $this->kernel;
    }

    /**
     * Providers registrados.
     *
     * @return ServiceProvider[]
     */
    public function providers(): array
    {
        return $this->providers;
    }

    /**
     * Indica se a aplicação já foi inicializada.
     */
    public function isBooted(): bool
    {
        return $this->booted;
    }
}