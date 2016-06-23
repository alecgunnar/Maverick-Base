<?php
/**
 * Maverick Base
 *
 * @author Alec Carpenter <aleccarpenter@quickenloans.com>
 */
declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Twig_Environment;

abstract class AbstractController
{
    /**
     * @var ServerRequestInterface $request
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var string[]
     */
    protected $params;

    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $respose
     * @param string[] $params
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $params): ResponseInterface
    {
        $this->request  = $request;
        $this->response = $response;
        $this->params   = $params;

        $ret = $this->doAction();

        return ($ret instanceof ResponseInterface) ? $ret : $this->response;
    }

    /**
     * @param Twig_Environment $env
     */
    public function setTemplateLoader(Twig_Environment $env)
    {
        $this->twig = $env;
    }

    /**
     * @param string $template
     * @param mixed[] $variables
     */
    protected function render(string $template, array $variables = [])
    {
        $rendered = $this->twig->render($template . '.twig', $variables);
        $this->response->getBody()->write($rendered);
    }

    /**
     * The action of the controller
     *
     * @return ResponseInterface|null
     */
    abstract protected function doAction();
}
