<?php

namespace ESGISGabon\PostBundle\Form;

use ESGISGabon\PostBundle\Entity\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    protected $id;

    public function __construct($id = 0)
    {
        $this->id = $id;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $this->id;

        $builder
            ->add('name', 'text')
            ->add('desc', 'textarea', array(
                'required' => false
            ))
            ->add('parent', 'entity', array(
                'class' => 'ESGISGabon\PostBundle\Entity\Category',
                'property' => 'name',
                'empty_value' => 'Aucun',
                'query_builder' => function (CategoryRepository $manager) use ($id) {
                    return $manager->anythingBut($id);
                }
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESGISGabon\PostBundle\Entity\Category'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'esgisgabon_postbundle_category';
    }
}
