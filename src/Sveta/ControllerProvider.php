<?php

namespace Sveta;

use Silex\Application as SilexApplication;
use Silex\ControllerProviderInterface;

class ControllerProvider implements ControllerProviderInterface
{
    public function connect(SilexApplication $application)
    {
        $controllers = $application['controllers_factory'];

        $controllers
            ->get('/', new Page\Index($application))
            ->bind('index');

        $controllers
            ->get('/{language}/home', new Page\Home($application))
            ->assert('language', $application['language_regexp'])
            ->bind('home');

        $controllers
            ->get('/{language}/service', new Page\Service($application))
            ->assert('language', $application['language_regexp'])
            ->bind('service');

        $controllers
            ->get('/{language}/experience', new Page\Experience($application))
            ->assert('language', $application['language_regexp'])
            ->bind('experience');

        $controllers
            ->match('/{language}/quote-{step}', new Page\Quote($application))
            ->assert('language', $application['language_regexp'])
            ->assert('step', 'form|requested')
            ->value('step', 'form')
            ->bind('quote');

        return $controllers;
    }
}
