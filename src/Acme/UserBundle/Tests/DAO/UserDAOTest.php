<?php
namespace Acme\UserBundle\Tests\DAO;

use Acme\UserBundle\DAO\UserDAO;
use Acme\UserBundle\Model\User;
use Kbrw\RiakBundle\Model\Cluster\Cluster;
use Kbrw\RiakBundle\Model\Bucket\InMemoryBucket;

class UserDAOTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @var \Acme\UserBundle\DAO\UserDAO
     */
    protected $userDAO;
    
    public function setUp() {
        parent::setup();
        $cluster = new Cluster();
        $cluster->setBuckets(array("user" => new InMemoryBucket(array(
            "remi.alvado@gmail.com" => new User("remi.alvado@gmail.com", "remi")
        ))));
        $this->userDAO = new UserDAO($cluster);
    }
    
    /**
     * @test 
     */
    public function getExistingUser() {
        assertThat($this->userDAO->findOne("remi.alvado@gmail.com"), is(new User("remi.alvado@gmail.com", "remi")));
    }
    
    /**
     * @test 
     */
    public function getNonExistingUser() {
        assertThat($this->userDAO->findOne("user@example.com"), is(nullValue()));
    }
    
    /**
     * @test 
     */
    public function createNewUser() {
        $user = new User("user@example.com", "user");
        assertThat($this->userDAO->createOrUpdate($user), is(true));
        assertThat($this->userDAO->findOne("user@example.com"), is($user));
    }
    
    /**
     * @test 
     */
    public function updateExistingUser() {
        $user = $this->userDAO->findOne("remi.alvado@gmail.com");
        $user->setName("remi.alvado");
        assertThat($this->userDAO->createOrUpdate($user), is(true));
        assertThat($this->userDAO->findOne("remi.alvado@gmail.com")->getName(), is("remi.alvado"));
    }
    
    /**
     * @test 
     */
    public function deleteExistingUser() {
        assertThat($this->userDAO->delete("remi.alvado@gmail.com"), is(true));
        assertThat($this->userDAO->findOne("remi.alvado@gmail.com"), is(nullValue()));
    }
    
    /**
     * @test 
     */
    public function deleteNonExistingUser() {
        assertThat($this->userDAO->delete("user@example.com"), is(false));
    }
}