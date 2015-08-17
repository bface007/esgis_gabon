<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 20:26
 */

namespace BluEstuary\UserBundle\Model;


use BluEstuary\CoreBundle\Model\CommonInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface OwnableInterface extends CommonInterface
{
    public function setOwner(UserInterface $owner);

    public function getOwner();
} 