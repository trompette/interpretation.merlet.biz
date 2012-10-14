<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Home extends ApplicationAware
{
    public function __invoke($language)
    {
        $this->application['monolog']->addInfo('Executing Home()');

        $template = sprintf('@%s/home.twig', $language);

        return $this->application['twig']->render($template, array(
            'language' => $language,
        ));
    }
}
