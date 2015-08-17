<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 04/08/2015
 * Time: 03:59
 */

namespace ESGISGabon\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Partner extends User
{

    /**
     * @var string
     * @ORM\Column(type="string", name="organization_name", length=40, nullable=true)
     */
    private $organizationName;

    /**
     * @var string
     * @ORM\Column(type="string", name="organisation_office", length=30, nullable=true)
     */
    private $organizationOffice;

    /**
     * @var string
     * @ORM\Column(type="string", name="partnership", length=30, nullable=true)
     */
    private $partnership;

    public function __construct()
    {
        // your own logic
    }

    /**
     * Set organizationName
     *
     * @param string $organizationName
     * @return Partner
     */
    public function setOrganizationName($organizationName)
    {
        $this->organizationName = $organizationName;

        return $this;
    }

    /**
     * Get organizationName
     *
     * @return string 
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * Set organizationOffice
     *
     * @param string $organizationOffice
     * @return Partner
     */
    public function setOrganizationOffice($organizationOffice)
    {
        $this->organizationOffice = $organizationOffice;

        return $this;
    }

    /**
     * Get organizationOffice
     *
     * @return string 
     */
    public function getOrganizationOffice()
    {
        return $this->organizationOffice;
    }

    /**
     * Set partnership
     *
     * @param string $partnership
     * @return Partner
     */
    public function setPartnership($partnership)
    {
        $this->partnership = $partnership;

        return $this;
    }

    /**
     * Get partnership
     *
     * @return string 
     */
    public function getPartnership()
    {
        return $this->partnership;
    }
}
