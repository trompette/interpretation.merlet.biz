<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Experience extends ApplicationAware
{
    public function __invoke($language)
    {
        $this->application['monolog']->addInfo('Executing Experience()');

        $template = sprintf('@%s/experience.twig', $language);

        return $this->application['twig']->render($template, array(
            'language' => $language,
        ));
    }
}
