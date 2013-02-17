<?php
namespace Acme\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class ViewUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('shopadv:user:view')
            ->setDescription('View an existing user from riak')
            ->addOption("email", null, InputOption::VALUE_REQUIRED, "User email")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userDAO = $this->getContainer()->get("kbrw.user.dao");
        $user = $userDAO->findOne($input->getOption("email"));
        print_r($user);
    }
}
