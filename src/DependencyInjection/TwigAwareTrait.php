<?php

namespace Sveta\DependencyInjection;

use Twig\Environment;

trait TwigAwareTrait
{
    protected $twig;

    /** @required */
    public function injectTwig(Environment $twig): void
    {
        $this->twig = $twig;
    }
}
