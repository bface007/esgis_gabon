<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/10/15
 * Time: 18:14
 */

namespace BluEstuary\CoreBundle\Form;


use BluEstuary\CoreBundle\Form\DataTransformer\EntityToIdTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntityHiddenType extends AbstractType
{
    protected $objectManager;

    public function __construct(ObjectManager $manager)
    {
        $this->objectManager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $transformer = new EntityToIdTransformer($this->objectManager, $options['class']);
//        $builder->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array('class'));
    }

    public function getParent()
    {
        return 'hidden';
    }
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'entity_hidden';
    }
}