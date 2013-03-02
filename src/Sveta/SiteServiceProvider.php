<?php

namespace Sveta;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class SiteServiceProvider implements ServiceProviderInterface
{
    public function register(Application $application)
    {
        $application['controller.index'] = $application->share(function() use ($application) {
            return new Controller\Index($application);
        });

        $application['controller.home'] = $application->share(function() use ($application) {
            return new Controller\Home($application);
        });

        $application['controller.service'] = $application->share(function() use ($application) {
            return new Controller\Service($application);
        });

        $application['controller.experience'] = $application->share(function() use ($application) {
            return new Controller\Experience($application);
        });

        $application['controller.quote'] = $application->share(function() use ($application) {
            return new Controller\Quote($application);
        });
    }

    public function boot(Application $application)
    {
        $application->before(function(Request $request) use ($application) {
            if (!$request->attributes->has('language')) {
                // guessing the preferred language
                $language_tags = array_keys($application['languages']);
                $language_tag = $request->getPreferredLanguage($language_tags);
                $language = $application['languages'][$language_tag];

                // adding language attribute to the request
                $request->attributes->set('language', $language);
            }
        });
    }
}