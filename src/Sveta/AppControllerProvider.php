<?php

namespace Sveta;

use Silex\Application as SilexApplication;
use Silex\ControllerProviderInterface;

class AppControllerProvider implements ControllerProviderInterface
{
    public function connect(SilexApplication $application)
    {
        // adding services
        $application['sveta.index'] = $application->share(function() use ($application) {
            return new Controller\Index($application);
        });

        $application['sveta.home'] = $application->share(function() use ($application) {
            return new Controller\Home($application);
        });

        $application['sveta.service'] = $application->share(function() use ($application) {
            return new Controller\Service($application);
        });

        $application['sveta.experience'] = $application->share(function() use ($application) {
            return new Controller\Experience($application);
        });

        $application['sveta.quote'] = $application->share(function() use ($application) {
            return new Controller\Quote($application);
        });

        // adding routes
        $controllers = $application['controllers'];

        $controllers
            ->get('/', 'sveta.index:execute')
            ->bind('index');

        $controllers
            ->get('/{language}/home', 'sveta.home:execute')
            ->assert('language', $application['language_regexp'])
            ->bind('home');

        $controllers
            ->get('/{language}/service', 'sveta.service:execute')
            ->assert('language', $application['language_regexp'])
            ->bind('service');

        $controllers
            ->get('/{language}/experience', 'sveta.experience:execute')
            ->assert('language', $application['language_regexp'])
            ->bind('experience');

        $controllers
            ->match('/{language}/quote-{step}', 'sveta.quote:execute')
            ->assert('language', $application['language_regexp'])
            ->assert('step', 'form|requested')
            ->value('step', 'form')
            ->bind('quote');

        return $controllers;
    }
}
