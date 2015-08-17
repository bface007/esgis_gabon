<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 03/08/2015
 * Time: 02:44
 */

namespace ESGISGabon\UserBundle\Entity;

use BluEstuary\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="esgis_user")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "student" = "Student", "manager" = "Manager", "professor" = "Professor", "partner" = "Partner"})
 */
class User extends BaseUser {

    /**
     * @var
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(type="string", name="lastname", length=40)
     */
    protected $lastname;

    /**
     * @var
     * @ORM\Column(type="string", name="firstname", length=40)
     */
    protected $firstname;

    /**
     * @var
     * @ORM\Column(type="date", name="birthday")
     */
    protected $birthday;

    /**
     * @var
     * @ORM\Column(type="string", name="place_of_birth", length=40, nullable=true)
     */
    protected $placeofbirth;

    /**
     * @var
     * @ORM\Column(type="string", name="address", length=50, nullable=true)
     */
    protected $address;

    /**
     * @var
     * @ORM\Column(type="integer", name="civility")
     */
    protected $civility = 1;

    /**
     * @var
     * @ORM\Column(type="string", name="account_status", length=10)
     */
    protected $account_status = "unused";

    /**
     * @var
     * @ORM\Column(type="string", name="account_type", length=15)
     */
    protected $account_type;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="ESGISGabon\UserBundle\Entity\Avatar", mappedBy="owner", cascade={"persist", "remove"})
     */
    protected $avatars;

    /**
     * @var
     * @ORM\Column(type="string", name="registration_number", unique=true, length=30, nullable=true)
     */
    protected $registration_number;

    public function __construct()
    {
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return User
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set placeofbirth
     *
     * @param string $placeofbirth
     * @return User
     */
    public function setPlaceofbirth($placeofbirth)
    {
        $this->placeofbirth = $placeofbirth;

        return $this;
    }

    /**
     * Get placeofbirth
     *
     * @return string 
     */
    public function getPlaceofbirth()
    {
        return $this->placeofbirth;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set civility
     *
     * @param integer $civility
     * @return User
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return integer 
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set account_status
     *
     * @param string $accountStatus
     * @return User
     */
    public function setAccountStatus($accountStatus)
    {
        $this->account_status = $accountStatus;

        return $this;
    }

    /**
     * Get account_status
     *
     * @return string 
     */
    public function getAccountStatus()
    {
        return $this->account_status;
    }

    /**
     * Set account_type
     *
     * @param string $accountType
     * @return User
     */
    public function setAccountType($accountType)
    {
        $this->account_type = $accountType;

        return $this;
    }

    /**
     * Get account_type
     *
     * @return string 
     */
    public function getAccountType()
    {
        return $this->account_type;
    }

    /**
     * Set registration_number
     *
     * @param string $registrationNumber
     * @return User
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registration_number = $registrationNumber;

        return $this;
    }

    /**
     * Get registration_number
     *
     * @return string 
     */
    public function getRegistrationNumber()
    {
        return $this->registration_number;
    }

    /**
     * Add avatars
     *
     * @param \ESGISGabon\UserBundle\Entity\Avatar $avatars
     * @return User
     */
    public function addAvatar(\ESGISGabon\UserBundle\Entity\Avatar $avatars)
    {
        $this->avatars[] = $avatars;

        return $this;
    }

    /**
     * Remove avatars
     *
     * @param \ESGISGabon\UserBundle\Entity\Avatar $avatars
     */
    public function removeAvatar(\ESGISGabon\UserBundle\Entity\Avatar $avatars)
    {
        $this->avatars->removeElement($avatars);
    }

    /**
     * Get avatars
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAvatars()
    {
        return $this->avatars;
    }
}
