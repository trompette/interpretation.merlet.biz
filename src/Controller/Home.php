<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Sveta\DependencyInjection\TwigAwareTrait;
use Symfony\Component\HttpFoundation\Response;

class Home implements LoggerAwareInterface
{
    use LoggerAwareTrait;
    use TwigAwareTrait;

    public function execute(string $language): Response
    {
        $this->logger->info("Executing Home($language)");

        return new Response($this->twig->render('template.twig'));
    }
}
