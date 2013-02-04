<?php

namespace Sveta\Controller;

use Sveta\ApplicationAware;

class Experience extends ApplicationAware
{
    public function execute()
    {
        $this['monolog']->addInfo('Executing Experience()');

        $template = sprintf('@%s/experience.twig', $this['language']);

        return $this['twig']->render($template, array('language' => $this['language']));
    }
}
