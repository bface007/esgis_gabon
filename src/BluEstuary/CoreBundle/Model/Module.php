<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 06/08/2015
 * Time: 00:13
 */

namespace BluEstuary\CoreBundle\Model;


use Doctrine\Common\Collections\ArrayCollection;

class Module implements ModuleInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var ArrayCollection
     */
    protected $permissions = array();

    public function getName()
    {
        return $this->name;
    }

    public function setName($name = null)
    {
        if(null === $name || false === is_string($name))
            trigger_error("setName expected Argument to be a string not null", E_USER_ERROR);
        $this->name = $name;

        return $this;
    }

    public function setCode($code = null)
    {
        if(null === $code || false === is_string($code))
            trigger_error("setCode expected Argument to be a string not null", E_USER_ERROR);
        $this->code = $code;

        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function addPermission($permission = null)
    {
        if(null === $permission || false === is_string($permission))
            trigger_error("addPermission expected Argument to be a string not null", E_USER_ERROR);
        $this->permissions[] = $permission;

        return $this;
    }

    public function removePermission($permission)
    {
        if(null === $permission || false === is_string($permission))
            trigger_error("removePermission expected Argument to be a string not null", E_USER_ERROR);

        $this->permissions->removeElement($permission);

        return $this;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function hasPermission($permission)
    {
        return in_array(strtoupper($permission), $this->getPermissions(), true);
    }

    public function __construct(){
        $this->permissions = new ArrayCollection();
    }
}