<?php

declare(strict_types=1);

namespace App\Action;

use Exception;
use Mailtrap\Config;
use Mailtrap\EmailHeader\CategoryHeader;
use Mailtrap\EmailHeader\CustomVariableHeader;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;

class SendEmailAction
{
    public function send($from, $fromName, $to, $toName, $subject, $body): void
    {
        try {
            $apiKey = getenv('MAILTRAP_API_KEY');
            $mailTrap = new MailtrapClient(new Config($apiKey));
            $email = (new Email())
                ->from(new Address($from, $fromName))
                ->to(new Address($to, $toName))
                ->subject($subject)
                ->text('Hey! Learn the best practices of building HTML emails and play with ready-to-go templates. Mailtrap’s Guide on How to Build HTML Email is live on our blog')
                ->html($body);
            $email->getHeaders()
                ->addTextHeader('X-Message-Source', 'domain.com')
                ->add(new UnstructuredHeader('X-Mailer', 'Mailtrap PHP Client'));
            $email->getHeaders()
                ->add(new CustomVariableHeader('user_id', '45982'))
                ->add(new CustomVariableHeader('batch_id', 'PSJ-12'));
            $email->getHeaders()->add(new CategoryHeader('Integration Test'));
            $response = $mailTrap->sending()->emails()->send($email);
            if (200 === $response->getStatusCode()) Info("Email for $to sent.");
        } catch (Exception $exception) {
            Info(request()->ip() . ':' . 'SendEmailAction@send - ' . $exception->getMessage());
        }
    }

}
