<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class Home implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function execute($language)
    {
        $this->logger->info("Executing Home($language)");

        return new Response($this->twig->render('template.twig'));
    }
}
