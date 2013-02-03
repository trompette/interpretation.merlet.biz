<?php

namespace Sveta;

use Silex\Application as SilexApplication;
use Silex\ServiceProviderInterface;

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

    }
}