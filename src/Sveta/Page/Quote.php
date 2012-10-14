<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Quote extends ApplicationAware
{
    public function __invoke($language)
    {
        $this->application['monolog']->addInfo('Executing Quote()');

        $template = sprintf('@%s/quote.twig', $language);

        return $this->application['twig']->render($template, array(
            'language' => $language,
        ));
    }
}
