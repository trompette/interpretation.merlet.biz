<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class Service implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function execute(string $language): Response
    {
        $this->logger->info("Executing Service($language)");

        return new Response($this->twig->render('template.twig'));
    }
}
