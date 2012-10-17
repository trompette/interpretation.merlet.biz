<?php

namespace Sveta;

use Monolog\Logger;
use Silex\Application as SilexApplication;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

class Application extends SilexApplication
{
    public function __construct($debug)
    {
        parent::__construct();

        // parameters definition
        $this['debug'] = $debug;
        $this['available_languages'] = array(
            'fr' => 'french',
            'en' => 'english',
            'ru' => 'russian',
            'uk' => 'ukrainian',
        );
        $this['language_regexp'] = implode('|', $this['available_languages']);

        // registering service providers 
        $this->register(new FormServiceProvider);
        $this->register(new MonologServiceProvider, array(
            'monolog.logfile' => __DIR__.'/../../log/sveta.log',
            'monolog.name'    => 'sveta',
            'monolog.level'   => $debug ? Logger::DEBUG : Logger::WARNING,
        ));
        $this->register(new TwigServiceProvider, array(
            'twig.path'       => __DIR__.'/Resources/views',
        ));
        $this->register(new UrlGeneratorServiceProvider);

        // configuring namespaced templates
        foreach ($this['available_languages'] as $language) {
            $dir = __DIR__.'/Resources/views/'.$language;
            $this['twig.loader.filesystem']->addPath($dir, $language);
        }

        // mounting routes
        $this->mount('/', new ControllerProvider);

        // handling errors
        //$this->error(new ErrorHandler($this));
    }
}
