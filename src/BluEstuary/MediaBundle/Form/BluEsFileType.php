<?php

namespace BluEstuary\MediaBundle\Form;

use BluEstuary\CoreBundle\Form\DataTransformer\EntityToIdTransformer;
use BluEstuary\MediaBundle\Form\DataTransformer\FileTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Storage\StorageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;

class BluEsFileType extends AbstractType
{
    protected $storage;
    protected $handler;
    protected $objectManager;

    public function __construct(StorageInterface $storage, UploadHandler $handler, ObjectManager $manager)
    {
        $this->storage = $storage;
        $this->handler = $handler;
        $this->objectManager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //$builder->addModelTransformer(new EntityToIdTransformer($this->objectManager, $options['class']));
        $transformer = new EntityToIdTransformer($this->objectManager, $options['class']);
        $builder->addModelTransformer($transformer);

        if($options['allow_delete'])
            $this->buildDeleteField($builder, $options);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array('field_name'))
            ->setDefaults(array(
            'allow_delete'  => true,
            'download_link' => true,
//            'data_class' => 'ESGISGabon\MediaBundle\Entity\Media'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['object'] = $form->getParent()->get($options['field_name'])->getData();

        if($options['download_link'] && $view->vars['object'])
            $view->vars['download_uri'] = $this->storage->resolveUri($view->vars['object'], 'file');
    }

    protected function buildDeleteField(FormBuilderInterface $builder, array $options)
    {
        $storage = $this->storage;
        $handler = $this->handler;



        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($options, $storage) {
                $form = $event->getForm()->getParent();

                $object = $event->getData();

//               throw new InvalidArgumentException(print_r($object));

                // no object or no uploaded file: no delete field
                if(null === $object || null === $storage->resolvePath($object, 'file'))
                    return;


                $form->add('delete', 'checkbox', array(
                    'required' => false,
                    'mapped' => false
                ));
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($handler) {
                $delete = $event->getForm()->has('delete') ? $event->getForm()->get('delete')->getData() : false;
                $object = $event->getData();

                if(!$delete)
                    return;

                $handler->remove($object, 'file');
            }
        );
    }

    public function getParent()
    {
        return 'entity_hidden';
    }

    public function getName()
    {
        return 'blu_es_file_type';
    }

}