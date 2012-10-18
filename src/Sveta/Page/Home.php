<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Home extends ApplicationAware
{
    public function __invoke($language)
    {
        $this['monolog']->addInfo('Executing Home()');

        $template = sprintf('@%s/home.twig', $language);

        return $this['twig']->render($template, array(
            'language' => $language,
        ));
    }
}
