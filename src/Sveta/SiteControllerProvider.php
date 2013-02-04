<?php

namespace Sveta;

use Silex\Application;
use Silex\ControllerProviderInterface;

class SiteControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $application)
    {
        $language_regexp = implode('|', $application['languages']);
        $controllers = $application['controllers'];

        $controllers
            ->get('/', 'controller.index:execute')
            ->bind('index');

        $controllers
            ->get('/{language}/home', 'controller.home:execute')
            ->assert('language', $language_regexp)
            ->bind('home');

        $controllers
            ->get('/{language}/service', 'controller.service:execute')
            ->assert('language', $language_regexp)
            ->bind('service');

        $controllers
            ->get('/{language}/experience', 'controller.experience:execute')
            ->assert('language', $language_regexp)
            ->bind('experience');

        $controllers
            ->match('/{language}/quote-{step}', 'controller.quote:execute')
            ->assert('language', $language_regexp)
            ->assert('step', 'form|requested')
            ->value('step', 'form')
            ->bind('quote');

        return $controllers;
    }
}
