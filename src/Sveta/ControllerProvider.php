<?php

namespace Sveta;

use Silex\Application as SilexApplication;
use Silex\ControllerProviderInterface;

class ControllerProvider implements ControllerProviderInterface
{
    public function connect(SilexApplication $application)
    {
        // adding services
        $application['sveta.index'] = $application->share(function() use ($application) {
            return new Page\Index($application);
        });

        $application['sveta.home'] = $application->share(function() use ($application) {
            return new Page\Home($application);
        });

        $application['sveta.service'] = $application->share(function() use ($application) {
            return new Page\Service($application);
        });

        $application['sveta.experience'] = $application->share(function() use ($application) {
            return new Page\Experience($application);
        });

        $application['sveta.quote'] = $application->share(function() use ($application) {
            return new Page\Quote($application);
        });

        // adding routes
        $controllers = $application['controllers'];

        $controllers
            ->get('/', 'sveta.index:render')
            ->bind('index');

        $controllers
            ->get('/{language}/home', 'sveta.home:render')
            ->assert('language', $application['language_regexp'])
            ->bind('home');

        $controllers
            ->get('/{language}/service', 'sveta.service:render')
            ->assert('language', $application['language_regexp'])
            ->bind('service');

        $controllers
            ->get('/{language}/experience', 'sveta.experience:render')
            ->assert('language', $application['language_regexp'])
            ->bind('experience');

        $controllers
            ->match('/{language}/quote-{step}', 'sveta.quote:render')
            ->assert('language', $application['language_regexp'])
            ->assert('step', 'form|requested')
            ->value('step', 'form')
            ->bind('quote');

        return $controllers;
    }
}
