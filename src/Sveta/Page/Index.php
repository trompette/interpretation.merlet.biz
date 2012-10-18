<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;
use Symfony\Component\HttpFoundation\Request;

class Index extends ApplicationAware
{
    public function __invoke(Request $request)
    {
        $this['monolog']->addInfo('Executing Index()');

        $available_tags = array_keys($this['available_languages']);
        $preferred_tag = $request->getPreferredLanguage($available_tags);
        $preferred_language = $this['available_languages'][$preferred_tag];

        $home_url = $this['url_generator']->generate('home', array('language' => $preferred_language));

        return $this->redirect($home_url);
    }
}
