<?php

namespace LineStorm\BlogBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostGalleryImageType extends AbstractBlogFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', 'textarea', array(
                'attr' => array(
                    'style' => 'height:200px;'
                ),
                //'inline' => true,
            ))
            ->add('seo')
            ->add('order', 'hidden')
            ->add('src', null, array(
                'read_only' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'label' => false,
            'data_class' => $this->modelManager->getEntityClass('post_gallery_image')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'linestorm_blogbundle_blogpostgallery';
    }
}
