<?php
namespace Acme\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class DeleteUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('shopadv:user:delete')
            ->setDescription('Delete an existing user from riak')
            ->addOption("email", null, InputOption::VALUE_REQUIRED, "User email")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userDAO = $this->getContainer()->get("kbrw.user.dao");
        return $userDAO->delete($input->getOption("email"));
    }
}
