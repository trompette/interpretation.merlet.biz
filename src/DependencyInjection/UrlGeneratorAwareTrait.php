<?php

namespace Sveta\DependencyInjection;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

trait UrlGeneratorAwareTrait
{
    protected $urlGenerator;

    /** @required */
    public function injectUrlGenerator(UrlGeneratorInterface $urlGenerator): void
    {
        $this->urlGenerator = $urlGenerator;
    }
}
