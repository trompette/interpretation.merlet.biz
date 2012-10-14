<?php

namespace Sveta;

use Symfony\Component\HttpFoundation\Response;

class ErrorHandler extends ApplicationAware
{
    public function __invoke(\Exception $exception, $code)
    {
        if ($this->application['debug']) {
            return new Response($exception->getMessage(), 500);
        }

        switch ($code) {
            case 404:
                $content = 'The requested resource could not be found.';
                $status = 404;
                break;

            default:
                $content = 'We are sorry, but something went terribly wrong.';
                $status = 500;
        }

        return new Response($content, $status);
    }
}
