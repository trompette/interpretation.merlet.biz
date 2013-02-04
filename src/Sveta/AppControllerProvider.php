<?php

namespace Sveta;

use Silex\Application as SilexApplication;
use Silex\ControllerProviderInterface;

class AppControllerProvider implements ControllerProviderInterface
{
    public function connect(SilexApplication $application)
    {
        $language_regexp = implode('|', $application['languages']);
        $controllers = $application['controllers'];

        $controllers
            ->get('/', 'sveta.index:execute')
            ->bind('index');

        $controllers
            ->get('/{language}/home', 'sveta.home:execute')
            ->assert('language', $language_regexp)
            ->bind('home');

        $controllers
            ->get('/{language}/service', 'sveta.service:execute')
            ->assert('language', $language_regexp)
            ->bind('service');

        $controllers
            ->get('/{language}/experience', 'sveta.experience:execute')
            ->assert('language', $language_regexp)
            ->bind('experience');

        $controllers
            ->match('/{language}/quote-{step}', 'sveta.quote:execute')
            ->assert('language', $language_regexp)
            ->assert('step', 'form|requested')
            ->value('step', 'form')
            ->bind('quote');

        return $controllers;
    }
}