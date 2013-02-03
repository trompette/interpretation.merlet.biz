<?php

namespace Sveta\Controller;

use Sveta\ApplicationAware;

class Index extends ApplicationAware
{
    public function execute()
    {
        $this['monolog']->addInfo('Executing Index()');

        $language_tag = $this['request']->getPreferredLanguage($this['language_tags']);
        $language = $this['languages'][$language_tag];

        return $this->redirect($this['url_generator']->generate('home', array('language' => $language)));
    }
}
