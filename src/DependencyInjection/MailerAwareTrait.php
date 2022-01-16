<?php

namespace Sveta\DependencyInjection;

use Symfony\Component\Mailer\MailerInterface;

trait MailerAwareTrait
{
    protected $mailer;

    /** @required */
    public function injectMailer(MailerInterface $mailer): void
    {
        $this->mailer = $mailer;
    }
}
