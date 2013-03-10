<?php

namespace Sveta;

use Monolog\Logger;
use Silex\Application;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

class FrontController
{
    protected $application = null;

    public function __construct($ga_tracking_id = null, $debug = false)
    {
        $this->application = new Application;

        // configuring application
        $this->application['languages'] = [
            'fr' => 'french',
            'en' => 'english',
            'ru' => 'russian',
            'uk' => 'ukrainian',
        ];
        $this->application['ga_tracking_id'] = $ga_tracking_id;
        $this->application['debug'] = $debug;

        // registering service providers
        $this->application->register(new MonologServiceProvider);
        $this->application->register(new ServiceControllerServiceProvider);
        $this->application->register(new SwiftmailerServiceProvider);
        $this->application->register(new TwigServiceProvider);
        $this->application->register(new UrlGeneratorServiceProvider);
        $this->application->register(new SiteServiceProvider);

        // overloading monolog configuration
        $this->application['monolog.level'] = $debug ? Logger::DEBUG : Logger::WARNING;
        $this->application['monolog.logfile'] = __DIR__.'/../../log/sveta.log';
        $this->application['monolog.name'] = 'sveta';

        // overloading swiftmailer configuration
        $this->application['swiftmailer.options'] = ['host' => 'localhost', 'port' => '25'];

        // overloading twig configuration
        $this->application['twig.path'] = __DIR__.'/Resources/views';
        foreach ($this->application['languages'] as $ns) {
            $this
                ->application['twig.loader.filesystem']
                ->addPath(__DIR__.'/Resources/views/'.$ns, $ns);
        }

        // mounting application routes
        $this->application->mount('/', new SiteControllerProvider);
    }

    public function run()
    {
        $this->application->run();
    }
}
