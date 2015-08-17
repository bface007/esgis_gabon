<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 18:29
 */

namespace BluEstuary\CoreBundle\Model;


interface ModuleInterface extends CommonInterface
{

    public function getName();

    public function setName($name);

    public function setCode($code);

    public function getCode();

    public function addPermission($permission);

    public function removePermission($permission);

    public function getPermissions();

    public function hasPermission($permission);
} 