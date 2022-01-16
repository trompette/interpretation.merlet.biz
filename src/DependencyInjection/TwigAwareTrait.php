<?php

namespace Sveta\DependencyInjection;

use Twig\Environment;

trait TwigAwareTrait
{
    protected $twig;

    /** @required */
    public function injectTwig(Environment $twig)
    {
        $this->twig = $twig;
    }
}
