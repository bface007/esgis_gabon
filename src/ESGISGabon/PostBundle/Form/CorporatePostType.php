<?php

namespace ESGISGabon\PostBundle\Form;

use BluEstuary\CoreBundle\Form\DataTransformer\EntityToIdTransformer;
use BluEstuary\MediaBundle\Form\EmbeddedFileType;
use Doctrine\Common\Persistence\ObjectManager;
use ESGISGabon\MediaBundle\Form\ImageType;
use ESGISGabon\PostBundle\Form\DataTransformer\MediaToId;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Storage\StorageInterface;

class CorporatePostType extends AbstractType
{
    protected $objectManager;

    public function __construct(ObjectManager $manager)
    {
        $this->objectManager = $manager;
    }

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
            ->add('cover', 'blu_es_file_type', array(
                'class' => 'ESGISGabonMediaBundle:Media',
                'field_name' => 'cover'
            ))
//                ->add('cover', 'hidden')
            ->add('keywords', 'tags', array(
                'by_reference' => false,
                'required' => false
            ))
        ;

//        $builder
//            ->get('cover')
//                ->addModelTransformer(new EntityToIdTransformer($this->objectManager, 'ESGISGabonMediaBundle:Media'));
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
