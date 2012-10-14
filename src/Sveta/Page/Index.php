<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;
use Symfony\Component\HttpFoundation\Request;

class Index extends ApplicationAware
{
    public function __invoke(Request $request)
    {
        $this->application['monolog']->addInfo('Executing Index()');

        $language = $request->getPreferredLanguage($this->application['available_languages']);

        return $this->application->redirect(
            $this->application['url_generator']->generate('home', array('language' => $language))
        );
    }
}
