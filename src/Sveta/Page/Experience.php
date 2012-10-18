<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Experience extends ApplicationAware
{
    public function __invoke($language)
    {
        $this['monolog']->addInfo('Executing Experience()');

        $template = sprintf('@%s/experience.twig', $language);

        return $this['twig']->render($template, array(
            'language' => $language,
        ));
    }
}
