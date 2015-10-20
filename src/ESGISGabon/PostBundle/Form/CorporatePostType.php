<?php

namespace ESGISGabon\PostBundle\Form;

use ESGISGabon\MediaBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CorporatePostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $corporate_post = $builder->getData();
        $builder
            ->add('postContent', 'textarea')
            ->add('postTitle', 'text')
            ->add('postStatus', 'choice', array(
                'choices' => array(
                    'pending' => 'En attente de relecture',
                    'publish' => 'Publier',
                    'draft' => 'Brouillon'
                ),
                'multiple' => false,
                'expanded' => false
            ))
            ->add('postType', 'entity', array(
                'class' => 'ESGISGabon\PostBundle\Entity\PostType',
                'property' => 'title',
                'expanded' => true,
                'multiple' => false
            ))
            ->add('categories', 'entity', array(
                'class' => 'ESGISGabon\PostBundle\Entity\Category',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('cover', new ImageType())
            ->add('keywords', 'tags', array(
                'by_reference' => false,
                'required' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESGISGabon\PostBundle\Entity\CorporatePost'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'esgisgabon_postbundle_corporatepost';
    }
}
