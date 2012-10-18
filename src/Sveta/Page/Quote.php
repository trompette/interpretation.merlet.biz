<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Quote extends ApplicationAware
{
    public function __invoke($language)
    {
        $this['monolog']->addInfo('Executing Quote()');

        $template = sprintf('@%s/quote.twig', $language);

        return $this['twig']->render($template, array(
            'language' => $language,
        ));
    }
}
