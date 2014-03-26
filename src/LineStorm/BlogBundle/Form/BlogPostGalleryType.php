<?php

namespace LineStorm\BlogBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostGalleryType extends AbstractBlogFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('images', 'dropzone', array(
                'type'      => new BlogPostGalleryImageType($this->modelManager),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'prototype_name' => '__img_name__'
            ))
            ->add('body', 'textarea', array(
                'attr' => array(
                    'style' => 'height:200px;'
                ),
                'label' => false,
                //'inline' => true,
            ))
            ->add('order', 'hidden')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->modelManager->getEntityClass('post_gallery')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'linestorm_blogbundle_blogpostgalleryimage';
    }
}
