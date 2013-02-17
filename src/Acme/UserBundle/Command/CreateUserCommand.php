<?php
namespace Acme\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('shopadv:user:put')
            ->setDescription('Create a new user in riak')
            ->addOption("email",    null, InputOption::VALUE_REQUIRED, "User email")
            ->addOption("username", null, InputOption::VALUE_REQUIRED, "User name")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userDAO = $this->getContainer()->get("kbrw.user.dao");
        return $userDAO->createOrUpdate(new \Acme\UserBundle\Model\User($input->getOption("email"), $input->getOption("username")));
    }
}
