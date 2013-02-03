<?php

namespace Sveta;

use Monolog\Logger;
use Silex\Application as SilexApplication;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

class Application extends SilexApplication
{
    public function __construct($debug)
    {
        parent::__construct();

        // overloading defaults
        $this['debug'] = $debug;

        // registering core service providers
        $this->register(new MonologServiceProvider);
        $this->register(new ServiceControllerServiceProvider);
        $this->register(new SwiftmailerServiceProvider);
        $this->register(new TwigServiceProvider);
        $this->register(new UrlGeneratorServiceProvider);

        // configuring application
        $this['ga_tracking_id'] = getenv('GA_TRACKING_ID');

        $this['languages'] = array(
            'fr' => 'french',
            'en' => 'english',
            'ru' => 'russian',
            'uk' => 'ukrainian',
        );
        $this['language_tags'] = array_keys($this['languages']);
        $this['language_regexp'] = implode('|', $this['languages']);

        $this['monolog.level'] = $debug ? Logger::DEBUG : Logger::WARNING;
        $this['monolog.logfile'] = __DIR__.'/../../log/sveta.log';
        $this['monolog.name'] = 'sveta';

        $this['twig.path'] = __DIR__.'/Resources/views';
        foreach ($this['languages'] as $language) {
            $dir = __DIR__.'/Resources/views/'.$language;
            $this['twig.loader.filesystem']->addPath($dir, $language);
        }

        // registering application service provider
        $this->register(new AppServiceProvider);

        // mounting application routes
        $this->mount('/', new AppControllerProvider);

        // setting error handler
        //$this->error(new ErrorHandler($this));
    }
}
