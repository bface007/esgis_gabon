<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 05/10/15
 * Time: 13:51
 */

namespace BluEstuary\PostBundle\Form\Type;

use BluEstuary\PostBundle\Form\DataTransformer\TagsTransformer;
use BluEstuary\PostBundle\Service\TagManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TagType extends AbstractType
{

    protected $tagManager;

    public function __construct(TagManager $tagManager)
    {
        $this->tagManager = $tagManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new TagsTransformer($this->tagManager);
        $builder->addModelTransformer($transformer);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'tags';
    }

    public function getParent()
    {
        return 'text';
    }
}