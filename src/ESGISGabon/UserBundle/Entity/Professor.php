<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 04/08/2015
 * Time: 04:11
 */

namespace ESGISGabon\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Professor extends User
{


    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="instructor_date_of_hire", nullable=true)
     */
    private $dateOfHire;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="instructor_date_of_termination", nullable=true)
     */
    private $dateOfTermination;

    public function __construct()
    {
        // your own logic
    }

    /**
     * Set dateOfHire
     *
     * @param \DateTime $dateOfHire
     * @return Instructor
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
     * @return Instructor
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
}
