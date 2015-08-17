<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 03/08/2015
 * Time: 19:29
 */

namespace BluEstuary\UserBundle\Model;

use BluEstuary\MediaBundle\Model\Image;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package BluEstuary\UserBundle\Model
 */
abstract class User extends BaseUser
{
    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var null|\DateTime
     */
    protected $birthday;

    /**
     * @var string
     */
    protected $placeofbirth;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var int
     */
    protected $civility = 1;

    /**
     * @var string
     */
    protected $account_status = "unused";



    /**
     * Sets user last name
     *
     * @param string $lastname
     * @return self
     */
    public function setLastName($lastname){
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Gets user last name
     *
     * @return string
     */
    public function getLastname(){
        return $this->lastname;
    }

    /**
     * Sets user first name
     *
     * @param string $firstname
     * @return self
     */
    public function setFirstName($firstname){
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Gets user first name
     *
     * @return string
     */
    public function getFirstName(){
        return $this->firstname;
    }

    /**
     * Sets user birth day
     *
     * @param \DateTime $birthday
     * @return self
     */
    public function setBirthDay(\DateTime $birthday){
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Gets user birth day
     *
     * @return null|\DateTime
     */
    public function getBirthDay(){
        return $this->birthday;
    }

    /**
     * Sets user place of birth
     *
     * @param string $placeofbirth
     * @return self
     */
    public function setPlaceOfBirth($placeofbirth){
        $this->placeofbirth = $placeofbirth;

        return $this;
    }

    /**
     * Gets user place of birth
     *
     * @return string
     */
    public function getPlaceOfBirth(){
        return $this->placeofbirth;
    }

    /**
     * Sets user address
     *
     * @param string $address
     * @return self
     */
    public function setAddress($address){
        $this->address = $address;

        return $this;
    }

    /**
     * Gets user address
     *
     * @return string
     */
    public function getAddress(){
        return $this->address;
    }

    /**
     * Sets user civility (1 = Mister, 2 = Madame, 3 = Miss)
     *
     * @param int $civility
     * @return self
     */
    public function setCivility($civility){
        if(false === is_int($civility) || !in_array($civility, array(1, 2, 3)))
            trigger_error("setCivility expected Argument to an integer among 1, 2 and 3", E_USER_ERROR);
        $this->civility = $civility;

        return $this;
    }

    /**
     * Gets user civility
     *
     * @return int
     */
    public function getCivility(){
        return $this->civility;
    }

    /**
     * Sets user account status
     *
     * @param string $accountStatus
     * @return self
     */
    public function setAccountStatus($accountStatus){
        if(null === $accountStatus || !in_array($accountStatus, array("unused", "open", "banished", "closed")))
            trigger_error("setAccountStatus expected Argument to be a string among 'unused', 'open', 'banished' and 'closed'", E_USER_ERROR);
        $this->account_status = $accountStatus;

        return $this;
    }

    /**
     * Gets user account status
     *
     * @return string
     */
    public function getAccountStatus(){
        return $this->account_status;
    }


} 