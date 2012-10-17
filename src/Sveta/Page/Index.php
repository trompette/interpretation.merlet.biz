<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;
use Symfony\Component\HttpFoundation\Request;

class Index extends ApplicationAware
{
    public function __invoke(Request $request)
    {
        $this->application['monolog']->addInfo('Executing Index()');

        $available_tags = array_keys($this->application['available_languages']);
        $preferred_tag = $request->getPreferredLanguage($available_tags);
        $preferred_language = $this->application['available_languages'][$preferred_tag];

        $home_url = $this->application['url_generator']->generate('home', array('language' => $preferred_language));

        return $this->application->redirect($home_url);
    }
}
