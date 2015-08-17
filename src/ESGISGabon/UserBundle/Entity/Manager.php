<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 04/08/2015
 * Time: 01:58
 */

namespace ESGISGabon\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Manager extends User
{

    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="manager_date_of_hire", nullable=true)
     */
    private $dateOfHire;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="manager_date_of_termination", nullable=true)
     */
    private $dateOfTermination;

    /**
     * @var string
     * @ORM\Column(type="string", name="manager_office", length=30, nullable=true)
     */
    private $office;


    public function __construct()
    {
        // your own logic
    }

    /**
     * Set dateOfHire
     *
     * @param \DateTime $dateOfHire
     * @return Manager
     */
    public function setDateOfHire($dateOfHire)
    {
        $this->dateOfHire = $dateOfHire;

        return $this;
    }

    /**
     * Get dateOfHire
     *
     * @return \DateTime 
     */
    public function getDateOfHire()
    {
        return $this->dateOfHire;
    }

    /**
     * Set dateOfTermination
     *
     * @param \DateTime $dateOfTermination
     * @return Manager
     */
    public function setDateOfTermination($dateOfTermination)
    {
        $this->dateOfTermination = $dateOfTermination;

        return $this;
    }

    /**
     * Get dateOfTermination
     *
     * @return \DateTime 
     */
    public function getDateOfTermination()
    {
        return $this->dateOfTermination;
    }

    /**
     * Set office
     *
     * @param string $office
     * @return Manager
     */
    public function setOffice($office)
    {
        $this->office = $office;

        return $this;
    }

    /**
     * Get office
     *
     * @return string 
     */
    public function getOffice()
    {
        return $this->office;
    }
}
