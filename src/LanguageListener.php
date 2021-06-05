<?php

namespace Sveta;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LanguageListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => 'onKernelRequest',
        );
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if ($request->attributes->has('language')) {
            return;
        }

        $request->attributes->set(
            'language',
            $this->guessPreferredLanguage($request)
        );
    }

    private function guessPreferredLanguage(Request $request)
    {
        $languages = array(
            'fr' => 'french',
            'en' => 'english',
            'ru' => 'russian',
            'uk' => 'ukrainian',
        );

        $language = $request->getPreferredLanguage(array_keys($languages));

        return $languages[$language];
    }
}
