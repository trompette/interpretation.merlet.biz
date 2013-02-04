<?php

namespace Sveta;

use Silex\Application as SilexApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AppServiceProvider implements ServiceProviderInterface
{
	public function register(SilexApplication $application)
	{
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
	}

    public function boot(SilexApplication $application)
    {
        $application->before(function(Request $request) use ($application) {
            if ($request->attributes->has('language')) {
                $language = $request->attributes->get('language');
            } else {
                $language_tags = array_keys($application['languages']);
                $language_tag = $request->getPreferredLanguage($language_tags);
                $language = $application['languages'][$language_tag];
            }

            $application['language'] = $language;
        });
    }
}
