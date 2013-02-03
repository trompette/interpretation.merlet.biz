<?php

namespace Sveta\Controller;

use Sveta\ApplicationAware;

class Service extends ApplicationAware
{
    public function execute($language)
    {
        $this['monolog']->addInfo('Executing Service()');

        $template = sprintf('@%s/service.twig', $language);

        return $this['twig']->render($template, array('language' => $language));
    }
}
