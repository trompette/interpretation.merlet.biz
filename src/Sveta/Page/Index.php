<?php

namespace Sveta\Page;

use Sveta\ApplicationAware;

class Index extends ApplicationAware
{
    public function render()
    {
        $this['monolog']->addInfo('Executing Index()');

        $language_tag = $this['request']->getPreferredLanguage($this['language_tags']);
        $language = $this['languages'][$language_tag];

        return $this->redirect($this['url_generator']->generate('home', array('language' => $language)));
    }
}
