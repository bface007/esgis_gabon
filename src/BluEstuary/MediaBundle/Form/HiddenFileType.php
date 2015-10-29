<?php

namespace BluEstuary\MediaBundle\Form;

use BluEstuary\CoreBundle\Form\EntityHiddenType;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Storage\StorageInterface;

class HiddenFileType extends AbstractType
{
    protected $storage;
    protected $handler;

    public function __construct(StorageInterface $storage, UploadHandler $handler)
    {
        $this->storage = $storage;
        $this->handler = $handler;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['allow_delete'])
            $this->buildDeleteField($builder, $options);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'allow_delete' => true,
            'download_link' => true
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['object'] = $form->getData();


        if($options['download_link'] && $view->vars['object'])
            $view->vars['download_uri'] = $this->storage->resolveUri($form->getData(), 'file');
    }

    public function getParent()
    {
        return 'entity_hidden';
    }

    public function getName()
    {
        return 'hidden_file';
    }

    protected function buildDeleteField(FormBuilderInterface $builder, array $options)
    {
        $storage = $this->storage;
        $handler = $this->handler;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($options, $storage) {
                $form = $event->getForm();

//                $object = $form->getParent()->getData();
                $object = $event->getData();

//                throw new InvalidArgumentException(print_r($event->getData()));


                // no object or no uploaded file: no delete field
                if(null === $object || null === $storage->resolvePath($object, 'file'))
                    return;


                $form->add('delete', 'checkbox', array(
                    'required' => false,
                    'mapped' => false,
                    'compound' => true
                ));
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($handler) {
                $delete = $event->getForm()->has('delete') ? $event->getForm()->get('delete')->getData() : false;
                $entity = $event->getData();

                if(!$delete)
                    return;

                $handler->remove($entity, 'file');
            }
        );
    }
}