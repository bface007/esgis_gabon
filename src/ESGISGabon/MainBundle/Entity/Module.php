<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 06/08/2015
 * Time: 00:12
 */

namespace ESGISGabon\MainBundle\Entity;

use BluEstuary\CoreBundle\Model\Module as Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Module
 * @package ESGISGabon\MainBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="esgis_site_module")
 */
class Module extends Base
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", name="module_id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name", length=20, nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", name="code", length=15, nullable=false)
     */
    protected $code;

    /**
     * @var array
     * @ORM\Column(type="simple_array", name="permissions")
     */
    protected $permissions = array();

    public function getId(){
        return $this->id;
    }
} 