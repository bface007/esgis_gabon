<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 26/10/15
 * Time: 17:34
 */

namespace BluEstuary\PostBundle\Service;


use BluEstuary\PostBundle\Model\PostCRUD;
use BluEstuary\PostBundle\Model\PostInterface;
use BluEstuary\PostBundle\Model\PostStatus;
use Doctrine\ORM\EntityManager;

class PostManager
{
    protected $em;

    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }

    public function generateSuccessMessage(PostInterface $post = null, $actionType = "")
    {
        $postType = $post === null ? $post : $post->getPostStatus();
        $successMessage = "";

        switch($postType)
        {
            case PostStatus::DRAFT :
                $successMessage = "Brouillon d'article mis à jour.";
                break;

            case PostStatus::PENDING :
                $successMessage = "Article en attente de relecture mis à jour.";
                break;

            case PostStatus::PUBLISHED:
                if(PostCRUD::CREATE === $actionType)
                    $successMessage = "Article créé.";
                else if(PostCRUD::UPDATE === $actionType)
                    $successMessage = "Article publié mis à jour.";
                break;

            case null:
                if(PostCRUD::DELETE === $actionType)
                    $successMessage = "Article supprimé.";
        }

        return $successMessage;
    }
}