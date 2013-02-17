<?php
namespace Acme\UserBundle\Model;

use JMS\Serializer\Annotation as Ser;

/**
 * @Ser\AccessType("public_method") 
 * @Ser\XmlRoot("user")
 */
class User
{
    /**
     * @Ser\Type("string") 
     * @Ser\SerializedName("email")
     */
    protected $email;
    
    /**
     * @Ser\Type("string") 
     * @Ser\SerializedName("name")
     * @Ser\Since("1")
     */
    protected $name;
    
    function __construct($email = null, $name = null)
    {
        $this->email = $email;
        $this->name = $name;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}