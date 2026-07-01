<?php

declare(strict_types=1);

namespace Akaza\Foundation;

use Throwable;

/**
 * Kernel principal da aplicação.
 *
 * Responsável por controlar o ciclo de execução
 * da AKAZA One.
 */
final class Kernel
{
    /**
     * Aplicação principal.
     */
    private Application $app;

    /**
     * Indica se o kernel foi iniciado.
     */
    private bool $initialized = false;

    /**
     * Lista de middlewares globais.
     *
     * Futuramente será populada
     * pelo sistema de Middleware.
     *
     * @var array<int, string>
     */
    private array $middleware = [];

    /**
     * Cria o Kernel.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Retorna a aplicação.
     */
    public function app(): Application
    {
        return $this->app;
    }

    /**
     * Executa o ciclo principal.
     */
    public function handle(): void
    {
        try {

            $this->initialize();

            $this->run();

        } catch (Throwable $exception) {

            $this->handleException($exception);

        }
    }


    /**
     * Inicialização do Kernel.
     */
    private function initialize(): void
    {
        if ($this->initialized) {
            return;
        }


        /**
         * Neste ponto futuramente:
         *
         * - carregar ambiente
         * - iniciar eventos
         * - iniciar middleware
         * - preparar request
         *
         */

        $this->initialized = true;
    }


    /**
     * Execução principal.
     */
    private function run(): void
    {
        /**
         * Enquanto o Router não existe,
         * mantemos um retorno simples.
         *
         * Futuramente:
         *
         * Request
         *    |
         * Middleware
         *    |
         * Router
         *    |
         * Controller
         *    |
         * Response
         */

        echo $this->welcomeMessage();
    }


    /**
     * Mensagem temporária do Kernel.
     *
     * Será substituída pela primeira View
     * oficial da AKAZA.
     */
    private function welcomeMessage(): string
    {
        return <<<HTML

        <h1>AKAZA One</h1>

        <p>
            Framework iniciado com sucesso.
        </p>

        <p>
            Kernel: ativo
        </p>

        HTML;
    }


    /**
     * Tratamento inicial de erros.
     *
     * Será substituído pelo Exception Handler.
     */
    private function handleException(
        Throwable $exception
    ): void {

        http_response_code(500);


        echo <<<HTML

        <h1>AKAZA One - Error</h1>

        <p>
            {$exception->getMessage()}
        </p>

        HTML;
    }


    /**
     * Adiciona middleware global.
     */
    public function middleware(
        string $middleware
    ): static {

        $this->middleware[] = $middleware;

        return $this;
    }


    /**
     * Lista middleware registrado.
     *
     * @return array<int,string>
     */
    public function middlewareList(): array
    {
        return $this->middleware;
    }


    /**
     * Verifica se o Kernel iniciou.
     */
    public function initialized(): bool
    {
        return $this->initialized;
    }
}