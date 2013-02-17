<?php
namespace Acme\UserBundle\DAO;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("kbrw.user.dao")
 */
class UserDAO
{

    /**
     * @param \Acme\UserBundle\Model\User $user
     * @return boolean true if succeed false otherwise
     */
    public function createOrUpdate($user)
    {
        return $this->userBucket->put(array($user->getEmail() => $user));
    }

    /**
     * @param string $email
     * @return \Acme\UserBundle\Model\User
     */
    public function findOne($email)
    {
        return $this->userBucket->uniq($email)->getContent();
    }

    /**
     * @param array<string> $emails
     * @return array<\Acme\UserBundle\Model\User>
     */
    public function find($emails)
    {
        return $this->userBucket->fetch($emails)->getContents();
    }

    /**
     * @param string $email
     * @return boolean true if succeed false otherwise
     */
    public function delete($email)
    {
        return $this->userBucket->delete($email);
    }
    
    /**
     * @DI\InjectParams({
     *     "riakCluster" = @DI\Inject("riak.cluster.backend")
     * })
     */
    public function __construct($riakCluster)
    {
        $this->userBucket = $riakCluster->getBucket("user");
    }

    /**
     * @var \Kbrw\RiakBundle\Model\Bucket\Bucket
     */
    public $userBucket;
    
}