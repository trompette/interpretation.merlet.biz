<?php

namespace Sveta;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LanguageListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
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

    private function guessPreferredLanguage(Request $request): string
    {
        $languages = [
            'fr' => 'french',
            'en' => 'english',
            'ru' => 'russian',
            'uk' => 'ukrainian',
        ];

        $language = $request->getPreferredLanguage(array_keys($languages));

        return $languages[$language];
    }
}
