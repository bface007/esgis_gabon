<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/08/15
 * Time: 17:17
 */

namespace ESGISGabon\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlogPost
 * @package ESGISGabon\PostBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="esgis_corporate_post")
 */
class CorporatePost extends Post
{
    /**
     * @var
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


} 