<?php
namespace Acme\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DebugUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('shopadv:user:debug')
            ->setDescription('Debug stuffs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bucket = $this->getContainer()->get("riak.cluster.backend")->getBucket("user");
        $bucket->put(
                new \Kbrw\RiakBundle\Model\KV\Data(
                        "foo@bar.com", 
                        new \Acme\UserBundle\Model\User("foo@bar.com", "foo"),
                        new \Symfony\Component\HttpFoundation\HeaderBag(array(
                            "X-Riak-Meta-Email-Domain" => "bar.com"
                        ))
                )
        );
        print_r($bucket->fetch("foo@bar.com"));        
    }
}
