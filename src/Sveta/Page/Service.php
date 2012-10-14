<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Service extends ApplicationAware
{
    public function __invoke($language)
    {
        $this->application['monolog']->addInfo('Executing Service()');

        $template = sprintf('@%s/service.twig', $language);

        return $this->application['twig']->render($template, array(
            'language' => $language,
        ));
    }
}
