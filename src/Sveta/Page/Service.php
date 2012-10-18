<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Service extends ApplicationAware
{
    public function __invoke($language)
    {
        $this['monolog']->addInfo('Executing Service()');

        $template = sprintf('@%s/service.twig', $language);

        return $this['twig']->render($template, array('language' => $language));
    }
}
