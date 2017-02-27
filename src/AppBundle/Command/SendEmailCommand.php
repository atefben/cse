<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SendEmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('atef:sendemail')
            ->setDescription('Send email')
            ->addArgument('emailfrom', InputArgument::REQUIRED, 'What\'s the sender email address?')
            ->addArgument('emailto', InputArgument::REQUIRED, 'What\'s the recipient email address?')
            ->addArgument('subject', InputArgument::REQUIRED, 'What\'s the email subject?')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $emailfrom = $input->getArgument('emailfrom');
        $emailto = $input->getArgument('emailto');

        $subject = $input->getArgument('subject');


        if ($emailfrom && $emailto) {

            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($emailfrom)
                ->setTo($emailto)
                ->setBody('test')
            ;
            $this->getContainer()->get('mailer')->send($message);

            $text = "Email sent!";
        } else {
            $text = 'Email not sent';
        }


        $output->writeln($text);
    }
}