<?php

namespace Sveta\Controller;

class Home extends ApplicationAware
{
    public function execute()
    {
        $this['monolog']->addInfo('Executing Home()');

        $template = sprintf('@%s/home.twig', $this['language']);

        return $this['twig']->render($template, array('language' => $this['language']));
    }
}
