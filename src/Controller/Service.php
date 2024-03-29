<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Sveta\DependencyInjection\TwigAwareTrait;
use Symfony\Component\HttpFoundation\Response;

class Service implements LoggerAwareInterface
{
    use LoggerAwareTrait;
    use TwigAwareTrait;

    public function __invoke(string $language): Response
    {
        $this->logger->info("Executing Service($language)");

        return new Response($this->twig->render('template.twig'));
    }
}
