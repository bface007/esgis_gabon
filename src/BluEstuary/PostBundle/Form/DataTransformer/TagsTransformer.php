<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/10/15
 * Time: 03:01
 */

namespace BluEstuary\PostBundle\Form\DataTransformer;


use BluEstuary\PostBundle\Service\TagManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagsTransformer implements DataTransformerInterface
{

    private $tagManager;

    public function __construct(TagManager $tagManager)
    {
        $this->tagManager = $tagManager;
    }

    /**
     * Transforms a value from the original representation to a transformed representation.
     *
     * By convention, transform() should return an empty string if NULL is
     * passed.
     *
     * @param mixed $value The value in the original representation
     *
     * @return mixed The value in the transformed representation
     *
     * @throws TransformationFailedException When the transformation fails.
     */
    public function transform($tags)
    {
        if(!is_null($tags))
            return $this->tagManager->getTagsNamesSeparated($tags->toArray());

        return '';
    }

    /**
     * Transforms a value from the transformed representation to its original
     * representation.
     *
     * By convention, reverseTransform() should return NULL if an empty string
     * is passed.
     *
     * @param mixed $value The value in the transformed representation
     *
     * @return mixed The value in the original representation
     *
     * @throws TransformationFailedException When the transformation fails.
     */
    public function reverseTransform($tags)
    {
        if(is_null($tags) || empty($tags) || $tags == '')
            return;

        return $this->tagManager->loadOrCreateTags(
            $this->tagManager->splitTagNames($tags)
        );
    }
}